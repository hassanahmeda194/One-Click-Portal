<?php

namespace App\Http\Controllers;

use App\Helpers\PortalHelpers;
use App\Models\Attendance\Attendance;
use App\Models\Auth\User;
use App\Models\BasicModels\UserDesignations;
use App\Models\Chats\ResearchOrderChat;
use App\Models\Chats\ResearchOrderChatAttachment;
use App\Models\ErrorLog;
use App\Models\LeaveEntitlements\LeaveSetting;
use App\Models\ResearchOrders\OrderAssigningInfo;
use App\Models\ResearchOrders\OrderClientInfo;
use App\Models\ResearchOrders\OrderInfo;
use App\Models\ResearchOrders\OrderTask;
use App\Models\ResearchOrders\TaskRevision;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;


class AjaxController extends Controller
{
    //
    public function getRegClient(Request $request): JsonResponse
    {
        $data = OrderClientInfo::where('Client_Name', 'LIKE', '%' . $request->input('query') . '%')->get();
        $Clients = $data->map(function ($row) {
            return $row->Client_Name;
        });
        return response()->json($Clients);
    }

    public function getClientInfo(Request $request): array
    {
        $data = OrderClientInfo::where('Client_Name', $request->input('query'))->firstOrFail();
        return [
            'Client_Code' => $data->id,
            'Client_Name' => $data->Client_Name,
            'Client_Phone' => $data->Client_Phone,
            'Client_Email' => $data->Client_Email,
            'Client_Country' => $data->Client_Country
        ];
    }

    public function getTaskRevisions(Request $request): string
    {
        if ($request->ajax()) {
            $data = TaskRevision::with(['revision_by.basic_info', 'attachments', 'task'])
                ->where('task_id', (int)$request->task_id)
                ->orderBy('id', 'DESC')
                ->get();

            if ($data->count() > 0) {
                return view('partials.research-order.get-task-revision', compact('data'))->render();
            }
        }

        return '<tr><td colspan="4">No Revisions found</td></tr>';
    }

    public function getEditTaskInfo(Request $request): array
    {
        $data = OrderTask::where('id', $request->input('task_id'))->first();
        return [
            'Selected_Date' => date('Y-m-d', strtotime($data->DeadLine)),
            'Selected_Time' => $data->DeadLine_Time,
            'Selected_Writer' => $data->assign_id,
            'Selected_Words' => (float)Str::replace(['$ ', ','], "", $data->Assign_Words),
            'Selected_Total_Words' => (float)Str::replace(['$ ', ','], "", $data->Total_Words),
            'Selected_Due_Words' => (float)Str::replace(['$ ', ','], "", $data->Due_Words),
        ];
    }

    public function getOrderInfo(Request $request): array
    {
        $data = OrderInfo::where('Order_ID', $request->input('Order_ID'))
            ->with([
                'submission_info',
                'basic_info',
                'content_info'
            ])->first();
        $WordCount = 0;
        if (isset($data->basic_info->Word_Count)) {
            $WordCount = (float)Str::replace(['$ ', ','], "", $data->basic_info->Word_Count);
        }
        if (isset($data->content_info->Word_Count)) {
            $WordCount = (float)Str::replace(['$ ', ','], "", $data->content_info->Word_Count);
        }
        return [
            'Selected_Date' => date('Y-m-d', strtotime($data->submission_info->DeadLine)),
            'Selected_Time' => date('h:i A', strtotime($data->submission_info->DeadLine_Time)),
            'Selected_Words' => $WordCount
        ];
    }

    public function getContentWriterInfo(Request $request): array
    {
        $data = OrderAssigningInfo::where('order_id', $request->input('Order_ID'))
            ->where('assign_id', $request->input('User_ID'))
            ->first();
        return [
            'Order_ID' => $data->order_id,
            'Assign_ID' => $data->assign_id,
        ];
    }

    public function postOrderChatMessages(Request $request): JsonResponse
    {
        $Chat_Message = ResearchOrderChat::create([
            'User_Message' => $request->Chat_Message,
            'is_executive' => (empty($request->is_executive)) ? 0 : $request->is_executive,
            'order_id' => (int)$request->order_id,
            'user_id' => (int)$request->user_id,
        ]);
        $Order_Info = OrderInfo::where('id', $request->order_id)->first();
        if ($Chat_Message) {
            if (!empty($request->file('files'))) {
                foreach ($request->file('files') as $key => $ImageFile) {
                    $imageGalleryName = $ImageFile->getClientOriginalName();
                    $ImageFile->move(public_path('Uploads/Chats/' . $request->order_id . '/'), $imageGalleryName);
                    $FileName = 'Uploads/Chats/' . $request->order_id . '/' . $imageGalleryName;
                    ResearchOrderChatAttachment::create([
                        'File_Name' => $imageGalleryName,
                        'file_path' => $FileName,
                        'msg_id' => $Chat_Message->id,
                    ]);
                }
            }


            $authUser = Auth::guard('Authorized')->user();
            $message = $Order_Info->Order_ID . '. This Order has a new Chat Message!';

            $orderType = OrderInfo::where('id', $request->order_id)->first();
            $Cordinator = "";
            $WritersID = OrderAssigningInfo::where('order_id', $request->order_id)->pluck('assign_id')->toArray();
            $taskWriter = OrderTask::where('order_id', $request->order_id)->where('assign_by', $authUser->id)->pluck('assign_id')->toArray();


            if ($orderType->Order_Type == 1) {
                $manager = 4;
            } elseif($orderType->Order_Type == 2) {
                $manager = 17;
            }elseif($orderType->Order_Type == 3 || $orderType->Order_Type == 4) {
                $manager = 1;
            }
            
            if ($authUser->Role_ID == 5) {
                $Cordinator = OrderTask::where('order_id', $request->order_id)->where('assign_by', $authUser->id)->pluck('assign_by')->toArray();
            }

            $array = [];
            $notify_id = [];

            $WritersID = $WritersID ?: [];
            $taskWriter = $taskWriter ?: [];
            $Cordinator = $Cordinator ?: [];

            if (in_array($authUser->Role_ID, [9, 10, 11])) {
                $array = [1, $manager, 9, 10, 11];
                $notify_id = $WritersID;
            } elseif ($authUser->Role_ID == 7 || in_array($authUser->Role_ID, [8, 12])) {
                $array = [1, $manager, 9, 10, 11];
            } elseif ($authUser->Role_ID == 6) {
                $array = [1, 4];
                $notify_id = $Cordinator;
            } elseif ($authUser->Role_ID == 5) {
                $array = [1, 4 , 9 ,10 ,11];
                $notify_id = $taskWriter;
            } elseif ($authUser->Role_ID == 4) {
                $array = [1, 9, 10, 11];
                $notify_id = array_merge($WritersID, $taskWriter);
            } elseif ($authUser->Role_ID == 1) {
                $array = [1, 4, 9, 10, 11];
                $notify_id = $WritersID;
            } elseif ($authUser->Role_ID == 17) {
                $array = [1, 9, 10, 11];
                $notify_id = $WritersID;
            }elseif ($authUser->Role_ID == 3) {
                $array = [1, 9, 10, 11];
                $notify_id = $WritersID;
            }


            PortalHelpers::sendNotification(
                null,
                $Order_Info->Order_ID,
                $message,
                $authUser->designation->Designation_Name,
                array_merge([$authUser->id], (array) $notify_id),
                $array
            );

            return response()->json(['message' => 'Message Sent.']);

            PortalHelpers::sendNotification(
                null,
                $Order_Info->Order_ID,
                $message,
                $authUser->designation->Designation_Name,
                array_merge([$authUser->id], (array) $notify_id),
                $array
            );

            return response()->json(['message' => 'Message Sent.']);
        }
        return response()->json(['message' => 'Message Not Sent.']);
    }


    public function getOrderChatMessages(Request $request): string
    {
        $currentUser = Auth::guard('Authorized')->user();
        $messages = $this->getOrderChat((int)$currentUser->Role_ID, $request);

        $output = '';

        if ($messages->count() > 0) {

            $previousDate = null;

            foreach ($messages as $message) {
                if (empty($message->authorized_user)) {
                    continue;
                }

                $photo = $message->authorized_user->basic_info->profile_photo_path ?? asset('assets/images/users/16.jpg');
                $dateString = $message->created_at;
                $dateString = preg_replace('/( AM| PM)/', '', $dateString);
                $messageDate = Carbon::parse($dateString, 'Asia/Karachi');
                $currentDate = $messageDate->format('M d, Y');

                // Display date separator if the current date is different from the previous date
                if ($currentDate !== $previousDate) {
                    $output .= View::make('partials.chat.date_separator', ['date' => $messageDate])->render();
                    $previousDate = $currentDate;
                }

                $executiveList = "<ul class='parent-container'>";
                $executiveIDs = [];
                if ($message->order_info->tasks) {
                    foreach ($message->order_info->tasks as $task) {
                        if ((int)$task->assign->Role_ID !== 6) {
                            continue;
                        }
                        if (in_array($task->assign_id, $executiveIDs, true)) {
                            continue;
                        }
                        $executiveIDs[] = $task->assign_id;
                        $executiveList .= "<li class='fs-14 mb-1'> <a href='#' class='Message_Forward'>Forward to <strong>" . $task->assign->basic_info->full_name . "</strong><span hidden class='Msg_ID d-none'>" . $message->User_Message . "</span><span class='Assign_ID d-none'>" . $task->assign->basic_info->user_id . "</span><span class='Order_ID d-none'>" . $task->order_id . "</span></a> </li>";
                    }
                }
                $executiveList .= "</ul>";

                $output .= View::make('partials.chat.message', [
                    'message' => $message,
                    'photo' => $photo,
                    'messageDate' => $messageDate,
                    'executiveList' => $executiveList,
                ])->render();

                if ($message->attachments->count() > 0) {
                    $output .= View::make('partials.chat.attachments', ['attachments' => $message->attachments])->render();
                }
            }
        }

        return $output;
    }



    private function getOrderChat($Role_ID, Request $request)
    {

        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        $query = ResearchOrderChat::OrderBy('created_at' , 'asc')
            ->with([
                'authorized_user' => function ($q) {
                    $q->select('id', 'Role_ID')->with([
                        'designation' => function ($q) {
                            $q->select('id', 'Designation_Name');
                        }
                    ]);
                },
                'order_info',
                'attachments'
            ])->whereRelation('order_info', 'id', (int)$request->Order_ID)->whereHas('authorized_user');

        if ($Role_ID == 6) {
            $query->whereHas('authorized_user', function ($q) {
                $q->whereIn('Role_ID', [4, 5, 6]);
            })->whereIn('is_executive', [1, 0])
                ->whereHas('order_info', function ($q) {
                    $q->with([
                        'tasks' => function ($q) {
                            $q->select('id', 'assign_id', 'order_id')->with([
                                'assign' => function ($q) {
                                    $q->select('id', 'Role_ID');
                                },
                                'assign.basic_info' => function ($q) {
                                    $q->select('F_Name', 'L_Name', 'user_id');
                                },
                            ]);
                        }
                    ]);
                });
        } elseif ($Role_ID == 4) {
            $query->whereHas('authorized_user', function ($q) {
                $q->whereIn('Role_ID', [1, 4, 5, 6, 7, 9, 10, 11]);
            });
        } elseif ($Role_ID == 5) {
            $query->whereHas('authorized_user', function ($q) {
                $q->whereIn('Role_ID', [1, 4, 5, 6, 7, 9, 10, 11]);
            });
        } elseif ($Role_ID == 9 || $Role_ID == 10 || $Role_ID == 11 || $Role_ID == 17) {
            $query->whereHas('authorized_user', function ($q) {
                $q->whereIn('Role_ID', [1, 4, 5, 7, 8, 9, 10, 11, 12, 17 ,3]);
            })->whereIn('is_executive', [0, 1]);
        } elseif ($Role_ID == 12 || $Role_ID == 8) {
            $query->whereHas('authorized_user', function ($q) {
                $q->whereIn('Role_ID', [1, 17, 8, 9, 10, 11, 12]);
            })->whereIn('is_executive', [0, 1])
                ->whereHas('order_info', function ($q) {
                    $q->with([
                        'tasks' => function ($q) {
                            $q->select('id', 'assign_id', 'order_id')->with([
                                'assign' => function ($q) {
                                    $q->select('id', 'Role_ID');
                                },
                                'assign.basic_info' => function ($q) {
                                    $q->select('F_Name', 'L_Name', 'user_id');
                                },
                            ]);
                        }
                    ]);
                });
        }


        return $query->get();
    }

    public function forwardToExecutive(Request $request): JsonResponse
    {
        $ResearchOrderChat = ResearchOrderChat::create([
            'is_executive' => 1,
            'User_Message' => $request->Msg_ID,
            'user_id' => (int)$request->Assign_ID,
            'order_id' => (int)$request->Order_ID,
        ]);

        if ($ResearchOrderChat) {
            return response()->json(['message' => 'Message Sent.']);
        }
        return response()->json(['message' => 'Message Not Sent.']);
    }

    public function getPortalPermissions(Request $request): \Illuminate\Contracts\View\View|Factory|JsonResponse|Application
    {
        if ($request->ajax()) {
            $module = UserDesignations::where('id', (int)$request->Role_ID)->with([
                'module_permission',
                'other_permission'
            ])->firstOrFail();

            if (!empty($module)) {
                $data = [
                    'role_id' => (int)$request->Role_ID,
                    'module_permission' => $module->module_permission,
                    'other_permission' => $module->other_permission
                ];
                return view('partials.portal-permissions', $data);
            }
            return response()->json(['error' => '404'], 404);
        }
        return response()->json(['error' => 'AJAX Not Called'], 400);
    }
    // Old Beofre Design Order
    // public function getPortalNotification(Request $request): JsonResponse
    // {

    //     try {
    //         if ($request->ajax()) {
    //             $portalNotification = PortalHelpers::getPortalNotification();

    //             $allNotifications = $portalNotification['Notifications'];
    //             $notificationsCount = $portalNotification['NotificationsCount'];

    //             $notifications = $allNotifications->map(function ($notify) {
    //                 $data = json_decode($notify->data, true, 512, JSON_THROW_ON_ERROR);
    //                 $route = (PortalHelpers::getOrderType($data['Order_ID']) === 1) ? route('Order.Details', ['Order_ID' => $data['Order_ID']]) : route('Content.Order.Details', ['Order_ID' => $data['Order_ID']]);
    //                 // if (PortalHelpers::getOrderType($data['Order_ID']) == 1) {
    //                 //     $route = route('Order.Details', ['Order_ID' => $data['Order_ID']]);
    //                 // } elseif ($data['Order_ID'] == 2) {
    //                 //     $route = route('Content.Order.Details', ['Order_ID' => $data['Order_ID']]);
    //                 // } elseif ($data['Order_ID'] == "leave_request") {
    //                 //     $route = route('Received.Request');
    //                 // }


    //                 $senderName = PortalHelpers::notificationSenderName($data['Role_Name']);
    //                 return [
    //                     'Emp_ID' => $data['Emp_ID'],
    //                     'Order_ID' => $data['Order_ID'],
    //                     'Role_Name' => $data['Role_Name'],
    //                     'Message' => $data['Message'],
    //                     'read_at' => $notify->read_at,
    //                     'created_at' => Carbon::parse($notify->created_at),
    //                     'route' => $route,
    //                     'Sender' => $senderName,
    //                     'id' => $notify->id
    //                 ];
    //             });

    //             if ($notifications->isNotEmpty()) {
    //                 return response()->json(['html' => view('partials.notification.notifications', compact('notifications', 'notificationsCount'))->render()]);
    //             }
    //             return response()->json(['html' => view('partials.notification.notification-not-found', compact('notifications', 'notificationsCount'))->render()]);
    //         }
    //         return response()->json(['error' => 'AJAX Not Called'], 400);
    //     } catch (\Exception $e) {
    //         Log::error($e->getMessage());
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }
    // Old Beofre Design Order


    // New After Design  Order

    public function getPortalNotification(Request $request): JsonResponse
    {
        try {
            if ($request->ajax()) {
                $portalNotification = PortalHelpers::getPortalNotification();

                $allNotifications = $portalNotification['Notifications'];
                $notificationsCount = $portalNotification['NotificationsCount'];

                $notifications = $allNotifications->map(function ($notify) {

                    $data = json_decode($notify->data, true, 512, JSON_THROW_ON_ERROR);
                    $route = '';
                    if (PortalHelpers::getOrderType($data['Order_ID']) === 1) {
                        $route = route('Order.Details', ['Order_ID' => $data['Order_ID']]);
                    } elseif (PortalHelpers::getOrderType($data['Order_ID']) === 2) {
                        $route = route('Content.Order.Details', ['Order_ID' => $data['Order_ID']]);
                    } elseif (PortalHelpers::getOrderType($data['Order_ID']) === 3) {
                        $route = route('Design.Order.View', ['Order_ID' => $data['Order_ID']]);
                    } elseif (PortalHelpers::getOrderType($data['Order_ID']) === 4) {
                        $route = route('Development.Order.View', ['Order_ID' => $data['Order_ID']]);
                    } elseif ($data['Order_ID'] == "leave_request") {
                        $route = route('Received.Request');
                    }
                    $senderName = PortalHelpers::notificationSenderName($data['Role_Name']);
                    return [
                        'Emp_ID' => $data['Emp_ID'],
                        'Order_ID' => $data['Order_ID'],
                        'Role_Name' => $data['Role_Name'],
                        'Message' => $data['Message'],
                        'read_at' => $notify->read_at,
                        'created_at' => Carbon::parse($notify->created_at),
                        'route' => $route,
                        'Sender' => $senderName,
                        'id' => $notify->id
                    ];
                });
                if ($notifications->isNotEmpty()) {
                    return response()->json(['html' => view('partials.notification.notifications', compact('notifications', 'notificationsCount'))->render()]);
                }
                return response()->json(['html' => view('partials.notification.notification-not-found', compact('notifications', 'notificationsCount'))->render()]);
            }
            return response()->json(['error' => 'AJAX Not Called'], 400);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    // New After Design  Order

    public function markAsReadNotification(Request $request): JsonResponse
    {
        try {
            if ($request->Notify_ID && $request->ajax()) {
                DB::table('notifications')->where('id', $request->Notify_ID)->update([
                    'read_at' => Carbon::now()
                ]);
            }
            return response()->json(['message' => 'Notification marked as read successfully']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function markReadNotification(Request $request): JsonResponse
    {
        try {
            if ($request->Notify_ID) {
                DB::table('notifications')->where('id', $request->Notify_ID)->update([
                    'read_at' => Carbon::now()
                ]);
            }
            return response()->json(['message' => 'Notification marked as read successfully']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function markAsAllReadNotification(Request $request): JsonResponse
    {
        try {
            if ($request->Notify_ID && $request->ajax()) {
                DB::table('notifications')->where('notifiable_id', $request->Notify_ID)->update([
                    'read_at' => Carbon::now(),
                    'is_clear' => 1
                ]);
            }
            return response()->json(['message' => 'All Notification marked as read successfully']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

  public function getSearchingRecords(Request $request)
{
    $query = $request->input('Query');
    $totalResults = OrderInfo::where('Order_ID', 'LIKE', '%' . $query . '%')->count();
    $startTime = microtime(true);
    $orderInfo = OrderInfo::with('client_info', 'submission_info', 'assign.basic_info', 'authorized_user.basic_info')
        ->where('Order_ID', 'LIKE', '%' . $query . '%')
        ->get();
    $endTime = microtime(true);
    $searchTime = number_format($endTime - $startTime, 2);
    $responseHtml = '';

    foreach ($orderInfo as $record) {
        $ViewOrderRoute = '';
        if ($record->Order_Type == 1) {
            $ViewOrderRoute = "/Authorized/View-Research-Order/{$record->Order_ID}";
        } else if ($record->Order_Type == 2) {
            $ViewOrderRoute = "/Authorized/View-Content-Order/{$record->Order_ID}";
        } else if ($record->Order_Type == 3) {
            $ViewOrderRoute = "/Authorized/Design-Order-View/{$record->Order_ID}";
        } else if ($record->Order_Type == 4) {
            $ViewOrderRoute = "/Authorized/Development-Order-View/{$record->Order_ID}";
        }

        $authUser = Auth::guard('Authorized')->user();
        if ($authUser->Role_ID == 4) {
            $responseHtml .= '<div class="card custom-card mb-3">
                <div class="card-body">
                    <div class="mb-2">
                        <a href="' . $ViewOrderRoute . '" class="h4 text-dark">Order ID: ' . $record->Order_ID . '</a>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-hover">
                            <tbody>
                                <tr>';
        } else {
            $responseHtml .= '<div class="card custom-card mb-3">
                <div class="card-body">
                    <div class="mb-2">
                        <a href="' . $ViewOrderRoute . '" class="h4 text-dark">Order ID: ' . $record->Order_ID . '</a>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td><strong>Client ID:</strong> ' . ($record->client_info['Client_Code'] ?? '') . '</td>
                                    <td><strong>Client Name:</strong> ' . ($record->client_info['Client_Name'] ?? '') . '</td>';
        }
 if ($authUser->Role_ID == 4) {
        if ($record->assign->isEmpty()) {
            $responseHtml .= '<td><strong>Assigned To:</strong> <span class="badge badge-danger">Not Assigned</span></td>';
        } else {
            foreach ($record->assign as $assignee) {
                $responseHtml .= '<td><strong>Assigned To:</strong> <span class="badge badge-success">' . ($assignee->basic_info['full_name'] ?? 'Not Assigned') . '</span></td>';
            }
        }
}
       $responseHtml .= '<td><a href="' . $ViewOrderRoute . '" class="btn btn-primary">View Order</a></td>
            </tr>
            </tbody>
            </table>
            </div>
            </div>
            </div>';

       

    }

    return response()->json(['data' => $responseHtml, 'totalResults' => $totalResults, 'searchTime' => $searchTime]);
}


    public function getAttendInfo(Request $request): JsonResponse
    {
        $Attend_Info = Attendance::where('id', $request->Attend_ID)->firstOrFail();

        return response()->json([
            'Attend_ID' => $Attend_Info->id,
            'check_in' => $Attend_Info->check_in ? Carbon::parse($Attend_Info->check_in)->format('h:i A') : 'N/A',
            'check_out' => $Attend_Info->check_out ? Carbon::parse($Attend_Info->check_out)->format('h:i A') : 'N/A',
            'created_at' => $Attend_Info->created_at,
            'ip_address' => $Attend_Info->ip_address,
            'status' => $Attend_Info->status,
            'total_time' => $Attend_Info->total_time ? date('H:i:s', strtotime($Attend_Info->total_time)) : 0,
        ]);
    }

    public function getLeaveInfo(Request $request): JsonResponse
    {
        $Leave_ID = $request->Leave_ID;
        $Leave_Info = LeaveSetting::find($Leave_ID)->first();
        if ($Leave_Info) {
            return response()->json([
                'id' => $Leave_Info->id,
                'Leave_Type' => $Leave_Info->Leave_Type,
                'Leave_numbers' => $Leave_Info->Leave_Numbers
            ]);
        }
        return response()->json(['Error!' => 'Data not found'], 404);
    }

    public function getEmpClient(Request $request): JsonResponse
    {
        $query = $request->input('query');

        $data = User::whereHas('basic_info', static function ($q) use ($query) {
            $q->whereRaw("CONCAT(F_Name, ' ', L_Name) LIKE '%$query%'")
                ->orWhereRaw("F_Name LIKE '%$query%'");
        })
            ->orWhere('EMP_ID', 'LIKE', '%' . $query . '%')
            ->get();

        return response()->json($data->map(function ($row) {
            return $row->basic_info->full_name;
        }));
    }

    public function getEmpInfo(Request $request): JsonResponse
    {
        $query = $request->input('query');
        $data = User::with(['basic_info', 'designation', 'basic_info.department'])
            ->whereHas('basic_info', function ($q) use ($query) {
                $q->whereRaw("CONCAT(F_Name, ' ', L_Name) = '$query'")
                    ->orWhereRaw("F_Name = '$query'");
            })
            ->get()->flatMap(function ($user) {
                return [
                    'Emp_ID' => $user->id,
                    'Full_Name' => $user->basic_info->full_name,
                    'Designation' => $user->designation->Designation_Name,
                    'Department' => $user->basic_info->department->Department_Name,
                ];
            });
        return response()->json($data);
    }

    public function getAttendData(Request $request): array
    {
        $ID = $request->EMP_Id;
        $user_Attendance_Info = User::with('basic_info', 'timing')->findOrFail($ID);
        $ip_address = PortalHelpers::getIpAddress();
        return [
            'user_id' => $user_Attendance_Info->id,
            'shift_start' => $user_Attendance_Info->timing->Start_Time,
            'shift_end' => $user_Attendance_Info->timing->End_Time,
            'IP_Address' => $ip_address
        ];
    }

    public function getPortalErrorFounds(Request $request): JsonResponse
    {
        if (!$request->ajax()) {
            return response()->json(['error' => 'AJAX Not Called'], 400);
        }

        $ErrorList = ErrorLog::latest('id')->get();
        $ErrorCount = count($ErrorList);

        return response()->json(['html' => view('partials.error-founds', compact('ErrorList', 'ErrorCount'))->render()]);
    }
}
