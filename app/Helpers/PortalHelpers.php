<?php

namespace App\Helpers;

use App\Models\Auth\User;
use App\Models\Auth\UserOfficeTiming;
use App\Models\ContentOrders\ContentBasicInfo;
use App\Models\ResearchOrders\OrderBasicInfo;
use App\Models\ResearchOrders\OrderClientInfo;
use App\Models\ResearchOrders\OrderInfo;
use App\Models\ResearchOrders\OrderTask;
use App\Notifications\PortalNotifications;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use InvalidArgumentException;
use Exception;
use Illuminate\Http\JsonResponse;
use PDO;
use Illuminate\Support\Facades\Cache;
use App\Models\Holiday\Holiday;



class PortalHelpers
{
    public static function convertYmdToMdy($date): string
    {
        return Carbon::createFromFormat('Y-m-d', $date)->format('m-d-Y');
    }

    public static function convertMdyToYmd($date): string
    {
        return Carbon::createFromFormat('m-d-Y', $date)->format('Y-m-d');
    }

    public static function visualizeRecordStatus($status)
    {
        if ($status === 'Working') {
            return '<span class="badge badge-primary mt-2">' . $status . '</span>';
        }
        if ($status === 'Completed') {
            return '<span class="badge badge-success mt-2">' . $status . '</span>';
        }
        if ($status === 'Revision') {
            return '<span class="badge badge-warning mt-2">' . $status . '</span>';
        }
        if ($status === 'Canceled') {
            return '<span class="badge badge-danger mt-2">' . $status . '</span>';
        }

        if ($status === 'Paid') {
            return '<span class="badge badge-success mt-2">' . $status . '</span>';
        }
        if ($status === 'Un-Paid') {
            return '<span class="badge badge-danger mt-2">' . $status . '</span>';
        }
        if ($status === 'Partial') {
            return '<span class="badge badge-primary mt-2">' . $status . '</span>';
        }

        return $status;
    }

    public static function checkValue($checkboxValue): string
    {
        if ((int)$checkboxValue === 1) {
            return 'checked';
        }
        return '';
    }

    public static function getPercentage($achieveWord, $target)
    {
        if (!is_numeric($target) || $target <= 0) {
            return '0.00 %';
        }
        if ($achieveWord < 0) {
            throw new InvalidArgumentException('Achieve word value must be non-negative.');
        }
        if (!is_numeric($achieveWord)) {
            throw new InvalidArgumentException('Achieve word value must be numeric.');
        }

        $percentage = ($achieveWord / $target) * 100;

        if ($achieveWord > $target) {
            $extraPercentage = (($achieveWord - $target) / $target) * 100;
            $percentage += $extraPercentage;
        }

        return number_format($percentage, 2) . '%';
    }


    public static function getOrderStatus($status)
    {
        if ((int)$status === 0) {
            return 'Working';
        }
        if ((int)$status === 1) {
            return 'Canceled';
        }
        if ((int)$status === 2) {
            return 'Completed';
        }
        if ((int)$status === 3) {
            return 'Revision';
        }
        return $status;
    }

    public static function getTargetAudienceGender($Target_Audience)
    {
        if ((int)$Target_Audience === 0) {
            return 'Male';
        }
        if ((int)$Target_Audience === 1) {
            return 'Female';
        }
        if ((int)$Target_Audience === 2) {
            return 'Male & Female Both';
        }
        return $Target_Audience;
    }

    public static function getFreeImage($Free_Image)
    {
        if ((int)$Free_Image === 0) {
            return 'Yes';
        }
        if ((int)$Free_Image === 1) {
            return 'No';
        }
        return $Free_Image;
    }

    public static function getGeneric_Type($Generic_Type)
    {
        if ((int)$Generic_Type === 0) {
            return 'Branded';
        }
        if ((int)$Generic_Type === 1) {
            return 'Generic';
        }
        return $Generic_Type;
    }

    public static function getPaymentStatus($status)
    {
        if ((int)$status === 0) {
            return 'Paid';
        }
        if ((int)$status === 1) {
            return 'Un-Paid';
        }
        if ((int)$status === 2) {
            return 'Partial';
        }
        return $status;
    }

    public static function getContentWriterData($Order_ID)
    {

        $data  = ContentBasicInfo::select('Word_Count', 'Order_Status')->where('order_id', $Order_ID)->first();

        return [
            'Order_Status'  => $data->Order_Status ?? '',
            'Word_Count'  => $data->Word_Count ?? ''
        ];
    }

    public static function getCordinatorData($id, $Order_Type)
    {
        if ($Order_Type == 2) {
            $wordCount = ContentBasicInfo::select('Word_Count', 'Order_Status')->where('order_id', $id)->first();
        } else {
            $wordCount = OrderBasicInfo::select('Word_Count', 'Order_Status')->where('order_id', $id)->first();
        }
        return [
            'word_Count' => $wordCount->Word_Count,
            'Order_Status' => $wordCount->Order_Status
        ];
    }


    public static function getSomeData($Order_ID, $client)
    {
        $cacheKey = "order_data_{$Order_ID}_{$client}";

        return cache()->remember($cacheKey, now()->addHours(24), function () use ($Order_ID, $client) {
            $Order_Number = OrderInfo::select('Order_ID', 'Order_Type')->where('id', $Order_ID)->first();

            if ($Order_Number->Order_Type == 1) {
                $OrderWord = OrderBasicInfo::select('Word_Count', 'Order_Status')->where('order_id', $Order_ID)->first();
            } else {
                $OrderWord = ContentBasicInfo::select('Word_Count', 'Order_Status')->where('order_id', $Order_ID)->first();
            }

            $client_Name = OrderClientInfo::select('Client_Name')->where('id', $client)->first();

            $data = [
                'Order_Type' => $Order_Number->Order_Type,
                'client_Name' => $client_Name->Client_Name,
                'Order_Number' => $Order_Number ? $Order_Number->Order_ID : null,
                'Order_Word_Count' => $OrderWord ? $OrderWord->Word_Count : null,
                'Order_Status' => $OrderWord ? $OrderWord->Order_Status : null,
            ];

            return $data;
        });
    }

    public static function getOrderType($Order_ID): ?int
    {
        if (empty($Order_ID)) {
            return null;
        }

        $cacheKey = 'order_type_' . $Order_ID;
        $orderType = Cache::remember($cacheKey, now()->addHours(24), function () use ($Order_ID) {
            $Order = OrderInfo::where('Order_ID', $Order_ID)->first();
            return $Order ? (int)$Order->Order_Type : null;
        });

        return $orderType;
    }


    public static function chatSenderName($Role_ID): ?string
    {
        if (in_array($Role_ID, [4, 5, 6, 7], true)) {
            return 'Production Team';
        }
        if (in_array($Role_ID, [8, 12], true)) {
            return 'Content Team';
        }
        if (in_array($Role_ID, [9, 10, 11], true)) {
            return 'Sales Team';
        }
        if ($Role_ID == 1) {
            return 'CEO';
        }
        return null;
    }

    public static function notificationSenderName($Role_Name): ?string
    {
        if (in_array($Role_Name, ['Research Manager', 'Re-Search Coordinator', 'Re-Search Writer', 'Independent Research Writer'], true)) {
            return 'Production Team';
        }
        if (in_array($Role_Name, ['Independent Content Writer', 'Content Writer'], true)) {
            return 'Content Team';
        }
        if (in_array($Role_Name, ['Sales Manager', 'Sales Coordinator', 'Sales Executive'], true)) {
            return 'Sales Team';
        }
        return $Role_Name;
    }

 public static function sendNotification(?string $order_id, ?string $Order_ID, string $message, string $role, array $User_IDs, array $Role_IDs): void
    {
        
        $currentUser = Auth::guard('Authorized')->user();

        $notificationData = [
            'Order_ID' => $Order_ID,
            'Role_Name' => $role,
            'Message' => $message,
            'Play_Sound' => true,
            'sender_user_id' => $currentUser->id
        ];

        if (empty($Order_ID)) {
            $Order_Info = OrderInfo::withTrashed()->find($order_id);
            $notificationData['Order_ID'] = $Order_Info->Order_ID;
        }

        $users = User::whereIn('id', $User_IDs)->orWhereIn('Role_ID', $Role_IDs)->get();
        Notification::send($users, new PortalNotifications($notificationData));
    }
    


    public static function getPageCount($Words, $Spacing): float
    {
        $perPage = match ($Spacing) {
            '1' => 550,
            '1.5' => 412,
            '2' => 275,
            default => 0,
        };

        if ($perPage > 0 && $Words > 0) {
            $result = $Words / $perPage;
        } else {
            $result = 0;
        }
        return round($result, 0);
    }

    public static function getIpAddress(): JsonResponse|string
    {
        $client = new Client();
        try {

            $response = $client->get('https://api.ipify.org');
            return $response->getBody()->getContents();
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $statusCode = $e->getResponse()->getStatusCode();
                $errorMessage = $e->getResponse()->getBody()->getContents();
                Log::error('Request failed with status code: ' . $statusCode);
                return response()->json(['error' => $errorMessage], $statusCode);
            }
            return response()->json(['error' => 'An error occurred. Please try again later.'], 500);
        } catch (Exception | GuzzleException $e) {
            return redirect()->route('Error.Response', ['Message' => $e->getMessage()]);
        }
    }

public static function getAttendanceStatus($status, $created_at = null)
{
    if ((int)$status == 0) {
        return 'Present';
    } elseif ((int)$status == 1) {
        return 'Absent';
    } elseif ((int)$status == 2) {
        return 'Late';
    } elseif ((int)$status == 3) {
        return 'Halfday';
    } elseif ((int)$status == 4) {
        return 'Annual';
    } elseif ((int)$status == 5) {
        return 'Casual';
    } elseif ((int)$status == 6) {
        return 'Sick';
    } elseif ((int)$status == 7) {
        return 'UnPaid';
    } elseif ((int)$status == 8 && $created_at !== null) {
        $date = Carbon::parse($created_at);
        $holiday = Holiday::where('date', $date)->first();
        return $holiday ? $holiday->name : 'Holiday'; 
    } elseif ((int)$status == 9) {
        return 'Not Mark';
    } elseif ((int)$status == 10) {
        return 'Sunday';
    } else {
        return 'Not Marked';
    }
}


           

    public static function visualizeAttendanceStatus($status)
    {
        if ($status === 'Present') {
            return '<span class="badge badge-primary mt-2">' . $status . '</span>';
        }
        if ($status === 'Absent') {
            return '<span class="badge badge-danger mt-2">' . $status . '</span>';
        }
        if ($status === 'Late') {
            return '<span class="badge badge-warning mt-2">' . $status . '</span>';
        }
        if ($status === 'Half-Day') {
            return '<span class="badge badge-warning mt-2">' . $status . '</span>';
        }
        if ($status === null) {
            return '<span class="badge badge-danger mt-2">Absent</span>';
        }
        return $status;
    }

    public static function calculateTotalTime($start, $end): string
    {
        return Carbon::parse($end)->diff(Carbon::parse($start))->format('%H:%I:%S'); // Output the total time
    }


    public static function setAttendanceStatus($check_in_time, $user_id): int
{
    $shiftTiming = UserOfficeTiming::where('user_id', $user_id)->pluck('Start_Time')->first();
    $checkIn = Carbon::parse($check_in_time);
    $shiftStart = Carbon::parse($shiftTiming);
    $shiftEnd = $shiftStart->copy()->addHours(9);
    $timeDifference = $checkIn->diffInMinutes($shiftStart);
    $user = User::find($user_id);

    if (in_array($user->Role_ID, [9, 10, 11]) && $checkIn->greaterThanOrEqualTo($shiftStart->addMinutes(5))) {
        return 2; 
    }

    if ($timeDifference >= 30) {
        return 2; 
    }

    
    if ($timeDifference >= 270) {
        return 3; 
    }

    return 0;
}

    
    public static function getLeaveStatus($status): string
    {
        if ((int)$status === 1) {
            return 'Accepted';
        }
        if ((int)$status === 2) {
            return 'Rejected';
        }
        if ((int)$status === 3) {
            return 'Un-Paid';
        }
        return 'Pending';
    }

    public static function getRemainingTime($date, $currentDate = null): string
    {
        $createdAtDate = Carbon::createFromFormat('F d, Y H:i:s A', $date, env('APP_TIMEZONE'))->startOfDay();
        if (!is_null($currentDate)) {
            $currentDate = Carbon::createFromFormat('F d, Y H:i:s A', $currentDate, env('APP_TIMEZONE'))->startOfDay();
        }
        if (is_null($currentDate)) {
            $currentDate = Carbon::parse($currentDate ?? 'now', env('APP_TIMEZONE'))->startOfDay();
        }

        $diff = $currentDate->diff($createdAtDate);
        $remainingTime = '';

        if ($diff->y > 0) {
            $remainingTime .= $diff->y . ' year' . ($diff->y > 1 ? 's ' : ' ');
        }

        if ($diff->m > 0) {
            $remainingTime .= $diff->m . ' month' . ($diff->m > 1 ? 's ' : ' ');
        }

        if ($diff->d > 0) {
            $remainingTime .= $diff->d . ' day' . ($diff->d > 1 ? 's ' : ' ');
        }

        return $remainingTime ?? 'Less than a day';
    }

    public static function getLeaveQuotaPercentage($total, $obtained): int
    {
        if ($total <= 0) {
            return 0;
        }

        return (int)(($obtained / $total) * 100);
    }


    public static function getPortalNotification(): array
    {
        $currentUser = Auth::guard('Authorized')->user();

        $filteredNotifications = DB::table('notifications')
            ->where('notifiable_id', '=', $currentUser->id)
            ->whereRaw('(JSON_UNQUOTE(JSON_EXTRACT(`data`, "$.sender_user_id")) IS NULL OR JSON_UNQUOTE(JSON_EXTRACT(`data`, "$.sender_user_id")) != ?)', [$currentUser->id])
            ->orderByDesc('created_at')
            ->limit(200)
            ->get();

        $notificationsCount = $filteredNotifications->whereNull('read_at')->count();

        return [
            'Notifications' => $filteredNotifications,
            'NotificationsCount' => $notificationsCount
        ];
    }
    public static function checkIsTaskAssign($order_id)
    {
        $checkIndependentWriter =  OrderTask::where('order_id', $order_id)->get();

        if ($checkIndependentWriter->count() > 0) {

            foreach ($checkIndependentWriter as $result) {

                if ($result->assign_id === null) {
                    return '<p class="text-danger fw-bold py-0 my-0">Not Assign</p>';
                } else {

                    $checkUserRole = User::where('id', $result->assign_id)->first();
                    if(isset($checkUserRole->Role_ID)){
                    
                    if ($checkUserRole->Role_ID == 7) {
                        $fullName = $checkUserRole->basic_info->F_Name . ' ' . $checkUserRole->basic_info->L_Name;
                        return '<p class="text-success fw-bold my-0 py-0">' . $fullName . '</p>';
                    } else {
                        return '<p class="text-danger fw-bold my-0 py-0">Not Assign</p>';
                    }
                    }
                }
            }
        }

        // If no records were found, return 'not assign'
        return '<p class="text-danger fw-bold my-0 py-0">Not Assign</p>';
    }

    public static function getOrderNumber($id)
    {
        $Order = OrderInfo::where('id', $id)->first();
        $output =  [
            'Order_Number' =>  $Order->Order_ID,
            'Order_Status' => ($Order->Order_Type == 1)
                ? OrderBasicInfo::where('order_id', $id)->pluck('Order_Status')->first()
                : ContentBasicInfo::where('order_id', $id)->pluck('Order_Status')->first()
        ];
        return $output;
    }
    public static function getPerformacePercentage($achieveWord, $cancelWord)
    {
        $totalWords = $achieveWord - $cancelWord;
        $percentage = ($totalWords > 0) ? (($achieveWord / $totalWords) * 100) : 0;
        return intval($percentage);
    }
}
