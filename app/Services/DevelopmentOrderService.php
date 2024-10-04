<?php

namespace App\Services;

use App\Models\ResearchOrders\OrderTask;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use App\Helpers\PortalHelpers;
use App\Models\AssignDeadLine;
use App\Models\Auth\User;
use App\Models\DesignOrderInfo;
use App\Models\Draft\DraftAttachment;
use App\Models\Draft\DraftSubmission;
use App\Models\ResearchOrders\ClientOrdersList;
use App\Models\ResearchOrders\FinalOrderSubmission;
use App\Models\ResearchOrders\OrderAssigningInfo;
use App\Models\ResearchOrders\OrderAttachment;
use App\Models\ResearchOrders\OrderClientInfo;
use App\Models\ResearchOrders\OrderDescriptionInfo;
use App\Models\ResearchOrders\OrderInfo;
use App\Models\ResearchOrders\OrderBasicInfo;

use App\Models\ResearchOrders\OrderPaymentInfo;
use App\Models\ResearchOrders\OrderReferenceInfo;
use App\Models\ResearchOrders\OrderRevision;
use App\Models\ResearchOrders\OrderRevisionAttachments;
use App\Models\ResearchOrders\OrderRevisonWord;
use App\Models\ResearchOrders\SubmitRevisionAttachment;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;
use App\Models\DevelopmentOrderInfo;
use App\Models\ResearchOrders\OrderSubmissionInfo;


class DevelopmentOrderService
{

    public function CreateDevelopmentOrder(Request $request)
    {
        $request->validate([
            'Order_ID' => 'required',
            'project_title' => 'required',
            'project_Service' => 'required',
            'DeadLine' => 'required',
            'DeadLine_Time' => 'required',
            'website_order' => 'required'
        ]);

        DB::beginTransaction();
        $checkClient = $this->getClientInfoFromRoute($request->Client_Code);
        $Order_Id = $this->getNewOrderID();
        $authUser = Auth::guard('Authorized')->user();
        if (empty($checkClient)) {
            $clientId = $this->createNewClient($request, $authUser);
            if (!$clientId) {
                DB::rollBack();
                return back()->with('Error!', "Order Client Failed!");
            }
        } else {
            $clientId = $checkClient->id;
        }


        $orderInfoID = $this->createOrderInfo($request, $authUser, $Order_Id, $clientId);

        if (!$orderInfoID) {
            DB::rollBack();
            return back()->with('Error!', "Order Failed!");
        }

        $clientOrderInfo = $this->createClientOrdersList($orderInfoID, $clientId);

        if (!$clientOrderInfo) {
            DB::rollBack();
            return back()->with('Error!', "Order Client Failed!");
        }

        $designOrderInfo = $this->createDevelopmentOrderInfo($request, $orderInfoID);

        if (!$designOrderInfo) {
            DB::rollBack();
            return back()->with('Error!', "Order Info Failed!");
        }
        $submissionInfo = $this->createOrderSubmissionInfo($request, $orderInfoID, $authUser->id, $clientId);

        if ($submissionInfo) {
            $reference_info = OrderReferenceInfo::create([
                'Reference_Code' => $request->Reference_Code,
                'order_id' => $orderInfoID,
                'user_id' => $authUser->id,
                'client_id' => $clientId
            ]);

            if ($reference_info) {

                $OrderPaymentInfo =  OrderPaymentInfo::create([
                    'Order_Price' => $request->Order_Price,
                    'Order_Currency' => $request->Order_Currency,
                    'Payment_Status' => $request->Payment_Status,
                    'Rec_Amount' => $request->Rec_Amount,
                    'Due_Amount' => $request->Due_Amount,
                    'Partial_Info' => $request->Partial_Info,
                    'order_id' => $orderInfoID,
                    'user_id' => $authUser->id,
                    'client_id' => $clientId
                ]);

                if ($OrderPaymentInfo) {
                    $OrderDescriptionInfo = OrderDescriptionInfo::create([
                        'Description' => $request->Order_Description,
                        'order_id' => $orderInfoID,
                        'user_id' => $authUser->id,
                        'client_id' => $clientId
                    ]);
                    if ($OrderDescriptionInfo) {
                        if (!empty($request->file('files'))) {
                            foreach ($request->file('files') as $key => $ImageFile) {
                                $imageGalleryName = $ImageFile->getClientOriginalName();
                                $ImageFile->move(public_path('Uploads/Attachments/' . $Order_Id . '/'), $imageGalleryName);
                                $FileName = 'Uploads/Attachments/' . $Order_Id . '/' . $imageGalleryName;
                                OrderAttachment::create([
                                    'File_Name' => $imageGalleryName,
                                    'order_attachment_path' => $FileName,
                                    'order_id' => $orderInfoID,
                                    'user_id' => $authUser->id,
                                    'client_id' => $clientId
                                ]);
                                $flag = true;
                            }

                            if ($flag) {
                                DB::commit();
                                $authUser = Auth::guard('Authorized')->user();
                                $Order_Number = OrderInfo::select('Order_ID')->where('Order_ID', $request->Order_ID)->first();

                                $message = $Order_Number->Order_ID . "Order Created Sucessfully.";
                                PortalHelpers::sendNotification(null, $request->Order_ID,  $message, $authUser->designation->Designation_Name, [$authUser->id], [1, 9, 10, 11]);
                                return redirect()->route('development.order.list')->with('Success!', "Order Created Successfully!");
                            }
                            DB::rollBack();
                            return back()->with('Error!', "Attachments Error!");
                        }
                        DB::commit();
                        $authUser = Auth::guard('Authorized')->user();
                        $Order_Number = OrderInfo::select('Order_ID')->where('Order_ID', $request->Order_ID)->first();
                        $message = $Order_Number->Order_ID . "Order Created Sucessfully.";
                        PortalHelpers::sendNotification(null, $request->Order_ID, $message, $authUser->designation->Designation_Name, [$authUser->id], [1,  9, 10, 11]);

                        return redirect()->route('development.order.list')->with('Success!', "Order Created Successfully!");
                    }
                    DB::rollBack();
                    return back()->with('Error!', "Order Description Info Failed!");
                }

                DB::rollBack();
                return back()->with('Error!', "Order Payment Info Failed!");
            }
            DB::rollBack();
            return back()->with('Error!', "Order Reference Info Failed!");
        }
        DB::rollBack();
        return back()->with('Error!', "Order Submission Info Failed!");
    }

    public function getClientInfoFromRoute($Client_ID)
    {
        return (!empty($Client_ID) ? OrderClientInfo::where('id', $Client_ID)->firstOrFail() : null);
    }

    public function getNewOrderID(): string
    {
        $month = Carbon::now()->month;

        $lastOrder = OrderInfo::withTrashed()
            ->whereMonth('created_at', $month)
            ->orderBy('created_at', 'desc')
            ->first();

        $lastOrderId = $lastOrder ? $lastOrder->Order_ID : 0;

        preg_match('/\d+$/', $lastOrderId, $matches);
        $numericPart = $matches[0] ?? 0;

        $currentYear = Carbon::now()->year;

        return 'OC-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-' . $currentYear . '-' . str_pad($numericPart + 1, 3, '0', STR_PAD_LEFT);
    }

    private function createNewClient($request, $authUser)
    {
        $Client_code = $this->getNewClientID();
        $orderClientInfo = OrderClientInfo::create([
            'Client_Code' => $Client_code,
            'Client_Name' => $request->Client_Name,
            'Client_Country' => $request->Client_Country,
            'Client_Email' => $request->Client_Email,
            'Client_Phone' => $request->Client_Phone,
            'user_id' => $authUser->id
        ]);
        return $orderClientInfo ? $orderClientInfo->id : null;
    }

    private function createOrderInfo($request, $authUser, $orderId, $clientId)
    {
        $orderInfo = OrderInfo::create([
            'Order_ID' => $orderId,
            'Order_Type' => 4,
            'user_id' => $authUser->id,
            'client_id' => $clientId,
            'assign_id' => null
        ]);

        return $orderInfo ? $orderInfo->id : null;
    }

    public function getNewClientID(): string
    {
        $lastClient = OrderClientInfo::orderBy('id', 'DESC')->first();
        if ($lastClient === null) {
            return 'Client' . '-1';
        }
        return 'Client' . '-' . ($lastClient->id + 1);
    }

    private function createClientOrdersList($orderId, $clientId)
    {
        $clientOrderInfo = ClientOrdersList::create([
            'order_id' => $orderId,
            'client_id' => $clientId
        ]);

        return $clientOrderInfo ? $clientOrderInfo->id : null;
    }

    private function createDevelopmentOrderInfo($request, $orderId)
    {
        $developmentOrderInfo = DevelopmentOrderInfo::create([
            'project_title' => $request->project_title,
            'project_service' => $request->project_Service,
            'website_order' => $request->website_order,
            'order_status' => $request->Order_Status,
            'order_id' => $orderId
        ]);

        return $developmentOrderInfo ? $developmentOrderInfo->id : null;
    }

    private function createOrderSubmissionInfo($request, $orderId, $authUserId, $clientId)
    {
        $submissionInfo = OrderSubmissionInfo::create([
            'DeadLine' => $request->DeadLine,
            'DeadLine_Time' => $request->DeadLine_Time,
            'F_DeadLine' => $request->F_DeadLine,
            'S_DeadLine' => $request->S_DeadLine,
            'T_DeadLine' => $request->T_DeadLine,
            'Four_DeadLine' => $request->Four_DeadLine,
            'Fifth_DeadLine' => $request->Fifth_DeadLine,
            'Sixth_DeadLine' => $request->Sixth_DeadLine,
            'Seven_DeadLine' => $request->Seven_DeadLine,
            'Eight_DeadLine' => $request->Eight_DeadLine,
            'nine_DeadLine' => $request->nine_DeadLine,
            'ten_DeadLine' => $request->ten_DeadLine,
            'eleven_DeadLine' => $request->eleven_DeadLine,
            'twelve_DeadLine' => $request->twelve_DeadLine,
            'thirteen_DeadLine' => $request->thirteen_DeadLine,
            'fourteen_DeadLine' => $request->fourteen_DeadLine,
            'fifteen_DeadLine' => $request->fifteen_DeadLine,
            'order_id' => $orderId,
            'user_id' => $authUserId,
            'client_id' => $clientId,
        ]);
        return $submissionInfo ? $submissionInfo->id : null;
    }

    public function getOrdersList($Role_ID, $User_ID)
    {
        $query = OrderInfo::with([
            'development_info',
            'authorized_user',
            'client_info',
            'submission_info',
            'payment_info',
            'basic_info',
            'assign',
        ])->where('Order_Type', 4);
        if ($Role_ID == 3) {
            $query->whereHas('assign', function ($query) use ($User_ID) {
                $query->where('assign_id', $User_ID);
            });
        }
        $designOrderList = $query->orderByDesc('id')->get();
        return $designOrderList;
    }

    public function getOrderDetail($Order_ID)
    {
        $auth_user = Auth::guard('Authorized')->user();
        return OrderInfo::where('Order_ID', $Order_ID)->with([
            'development_info',
            'authorized_user' => function ($q) {
                $q->with([
                    'basic_info' => function ($q) {
                        $q->select('id', 'F_Name', 'L_Name', 'user_id');
                    }
                ]);
            },
            'client_info',
            'submission_info',
            'payment_info',
            'attachments',
            'reference_info',
            'assign',
            'draftSubmissions' => function ($q) {
                $q->with('attachments');
            },
            'final_submission',
            'revision',
            'assign_dead_lines' => function ($q) use ($auth_user) {
                $q->where('user_id', $auth_user->id);
            }
        ])->first();
    }

    public function DeleteDevelopmentOrder($Order_ID)
    {
        $order_id = Crypt::decryptString($Order_ID);
        $DeleteOrder = OrderInfo::where('id', $order_id)->delete();
        if ($DeleteOrder) {
            return redirect()->route('development.order.list')->with('Success!', "Order Deleted Successfully!");
        }
        return back()->with('Error!', "Order Deleted Failed!");
    }
    public function updateDevelopmentOrder(Request $request)
    {
        // dd($request->toArray());
        $Order_ID = $request->Order_ID;
        $authUser = Auth::guard('Authorized')->user();
        $order_id = OrderInfo::where('Order_ID', $Order_ID)->pluck('id');
        DB::beginTransaction();
        $UpdateOrder = OrderInfo::where('Order_ID', $Order_ID)->update([
            'Order_Type' => 4,
        ]);
        if ($UpdateOrder) {
            $OrderDevelopmentInfo =  DevelopmentOrderInfo::where('order_id', $order_id)->update([
                'project_title' => $request->project_title,
                'project_service' => $request->project_Service,
                'website_order' => $request->website_order,
                'order_status' => $request->Order_Status,
            ]);
            if ($OrderDevelopmentInfo) {
                $OrderSubmissionInfo = OrderSubmissionInfo::where('order_id', $order_id)->update([
                    'DeadLine' => $request->DeadLine,
                    'DeadLine_Time' => $request->DeadLine_Time,
                    'F_DeadLine' => $request->F_DeadLine,
                    'S_DeadLine' => $request->S_DeadLine,
                    'T_DeadLine' => $request->T_DeadLine,
                    'Four_DeadLine' => $request->Four_DeadLine,
                    'Fifth_DeadLine' => $request->Fifth_DeadLine,
                    'Sixth_DeadLine' => $request->Sixth_DeadLine,
                    'Seven_DeadLine' => $request->Seven_DeadLine,
                    'Eight_DeadLine' => $request->Eight_DeadLine,
                    'nine_DeadLine' => $request->nine_DeadLine,
                    'ten_DeadLine' => $request->ten_DeadLine,
                    'eleven_DeadLine' => $request->eleven_DeadLine,
                    'twelve_DeadLine' => $request->twelve_DeadLine,
                    'thirteen_DeadLine' => $request->thirteen_DeadLine,
                    'fourteen_DeadLine' => $request->fourteen_DeadLine,
                    'fifteen_DeadLine' => $request->fifteen_DeadLine,
                ]);
                if ($OrderSubmissionInfo) {
                    $OrderRefrenceInfo = OrderReferenceInfo::where('order_id', $order_id)->update([
                        'Reference_Code' => $request->Reference_Code,
                    ]);
                    if ($OrderRefrenceInfo) {
                        $OrderPaymentInfo =  OrderPaymentInfo::where('order_id', $order_id)->update([
                            'Order_Price' => $request->Order_Price,
                            'Order_Currency' => $request->Order_Currency,
                            'Payment_Status' => $request->Payment_Status,
                            'Rec_Amount' => $request->Rec_Amount,
                            'Due_Amount' => $request->Due_Amount,
                            'Partial_Info' => $request->Partial_Info,
                        ]);
                        if ($OrderPaymentInfo) {
                            $OrderDescriptionInfo = OrderDescriptionInfo::where('order_id', $order_id)->update([
                                'Description' => $request->Order_Description,
                            ]);
                            if ($OrderDescriptionInfo) {
                                if (!empty($request->file('files'))) {
                                    foreach ($request->file('files') as $key => $ImageFile) {
                                        $imageGalleryName = $ImageFile->getClientOriginalName();
                                        $ImageFile->move(public_path('Uploads/Attachments/' . $Order_ID . '/'), $imageGalleryName);
                                        $FileName = 'Uploads/Attachments/' . $Order_ID . '/' . $imageGalleryName;
                                        OrderAttachment::where('order_id', $order_id)->update([
                                            'File_Name' => $imageGalleryName,
                                            'order_attachment_path' => $FileName,
                                        ]);
                                        $flag = true;
                                    }
                                    if ($flag) {
                                        DB::commit();
                                        return redirect()->route('development.order.list')->with('Success!', "Order updated Successfully!");
                                    }
                                    DB::rollBack();
                                    return back()->with('Error!', "Attachments Error!");
                                }
                                DB::commit();
                                return redirect()->route('development.order.list')->with('Success!', "Order updated Successfully!");
                            }
                        } else {
                            return back()->with('Error!', "Order Description Info Failed!");
                        }
                    } else {
                        return back()->with('Error!', "Order Reference Info Failed!");
                    }
                } else {
                    return back()->with('Error!', "Order Development Info Failed!");
                }
            } else {
                return back()->with('Error!', "Order Development Info Failed!");
            }
        } else {
            return back()->with('Error!', "Order Info Failed!");
        }
    }


    public function assignOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            $Order = OrderInfo::where('Order_ID', $request->Order_ID)->firstOrFail();
            $users = User::findMany($request->Assign_ID);
            $userIds = [];

            foreach ($users as $user) {
                if (!$Order->assign->contains('id', $user->id)) {
                    OrderAssigningInfo::create([
                        'order_id' => $Order->id,
                        'assign_id' => $user->id,
                    ]);
                    AssignDeadLine::create([
                        'deadline_date' => $request->DeadLine,
                        'deadline_time' => $request->DeadLine_Time,
                        'first_draft' => $request->F_DeadLine,
                        'second_draft' => $request->S_DeadLine,
                        'third_draft' => $request->T_DeadLine,
                        'forth_draft' => $request->Four_DeadLine,
                        'fifth_draft' => $request->Fifth_DeadLine,
                        'sixth_draft' => $request->Sixth_DeadLine,
                        'seventh_draft' => $request->Seven_DeadLine,
                        'eighth_draft' => $request->Eight_DeadLine,
                        'nineth_draft' => $request->nine_DeadLine,
                        'tenth_draft' => $request->ten_DeadLine,
                        'eleventh_draft' => $request->eleven_DeadLine,
                        'twelveth_draft' => $request->twelve_DeadLine,
                        'thirteen_draft' => $request->thirteen_DeadLine,
                        'fourteen_draft' => $request->fourteen_DeadLine,
                        'fifteen_draft' => $request->fifteen_DeadLine,
                        'order_id' => $Order->id,
                        'user_id' => $user->id,
                    ]);
                }
            }
            foreach ($users as $user) {
                $userIds[] = (int)$user->id;
            }
            $authUser = Auth::guard('Authorized')->user();
            $usersToNotify = array_merge([(int)$authUser->id], $userIds);
            $message = $request->Order_ID . ' has been Assigned Successfully!.';
            PortalHelpers::sendNotification(null, $request->Order_ID, $message, $authUser->designation->Designation_Name, (array)$usersToNotify, [1]);

            DB::commit();
            return back()->with('Success!', "Order Assigned Successfully!");
        } catch (ModelNotFoundException | \Exception $e) {
            DB::rollBack();
            return redirect()->route('Error.Response', ['Message' => $e->getMessage()]);
        }
    }

    public function CancelOrder($Order_ID)
    {
        $order_id = Crypt::decryptString($Order_ID);

        $CancelOrder =  DevelopmentOrderInfo::where('order_id', $order_id)->update([
            'order_status' => 1
        ]);
        if ($CancelOrder) {
            return back()->with('Success!', "Order Cancelled Successfully!");
        }
        return back()->with('Error!', "Order Cancelled Failed!");
    }

    public function DeleteOrder($Order_ID)
    {

        $order_id = Crypt::decryptString($Order_ID);
        $DeleteOrder = OrderInfo::where('id', $order_id)->delete();
        if ($DeleteOrder) {
            return redirect()->route('development.order.list')->with('Success!', "Order Deleted Successfully!");
        }
        return back()->with('Error!', "Order Deleted Failed!");
    }

    public function DevelopmentDraftSubmission(Request $request)
    {
        DB::beginTransaction();
        $draft_submission = DraftSubmission::create([
            'order_id' => $request->order_id,
            'order_number' => $request->Order_Number,
            'submitted_by' => $request->user_id,
            'draft_number' => $request->draft_number
        ]);
        if ($draft_submission) {
            $uploadedFiles = $request->file('files');
            if ($uploadedFiles) {
                foreach ($uploadedFiles as $key => $file) {
                    $fileName = $file->getClientOriginalName();
                    $filePath = 'Uploads/Draft-Attachments/' . $request->Order_Number . '/' . $request->draft_number . '/' . $fileName;
                    $file->move(public_path('Uploads/Draft-Attachments/' . $request->Order_Number . '/' . $request->draft_number), $fileName);
                    DraftAttachment::create([
                        'File_Name' => $fileName,
                        'File_Path' => $filePath,
                        'Draft_submission_id' => $draft_submission->id,
                    ]);
                }
                DB::commit();
                $authUser = Auth::guard('Authorized')->user();
                PortalHelpers::sendNotification(null, $request->Order_Number, 'The Order ' . $request->Order_Number . ' Draft has been  Submitted!', $authUser->designation->Designation_Name, [(int)$authUser->id], [1, 9, 10, 11]);
                return back()->with('Success!', "Draft Submitted successfully");
            } else {
                DB::rollBack();
                return back()->with('Error!', "Draft Files not uploaded!");
            }
        } else {
            DB::rollBack();
            return back()->with('Error!', "Draft Upload Failed!");
        }
    }

    public function DevelopmentOrderSubmission(Request $request)
    {
        DB::beginTransaction();
        $authUser = Auth::guard('Authorized')->user();
        try {
            DevelopmentOrderInfo::where('order_id', $request->order_id)
                ->update(['Order_Status' => 2]);

            $this->orderFinalSubmission($request);
            DB::commit();
            PortalHelpers::sendNotification(null, $request->Order_ID, 'The Order ' . $request->ID . ' Has Been Submitted!', $authUser->designation->Designation_Name, [(int)$authUser->id], [1, 9, 10, 11]);
            return back()->with('Success!', 'Final Files Submitted Successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            $message = $e->getMessage() . $e->getFile() . $e->getLine();
            return redirect()->route('Error.Response', ['Message' => $message]);
        }
    }

    private function orderFinalSubmission(Request $request): void
    {
        $uploadedFiles = $request->file('files');

        foreach ($uploadedFiles as $key => $file) {
            $fileName = $file->getClientOriginalName();
            $filePath = 'Uploads/Final-Attachments/' . $request->Order_ID . '/' . $fileName;

            $file->move(public_path('Uploads/Final-Attachments/' . $request->Order_ID), $fileName);

            FinalOrderSubmission::create([
                'File_Name' => $fileName,
                'final_submission_path' => $filePath,
                'order_id' => $request->order_id,
                'user_id' => $request->submit_by,
            ]);
        }
    }

    public function DevelopmentOrderRevision(Request $request)
    {
        DB::beginTransaction();
        try {
            $DevelopementOrderInfo = DevelopmentOrderInfo::where('order_id', $request->order_id)->first();
            return $this->OrderRevision($request, $DevelopementOrderInfo);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('Error.Response', ['Message' => $e->getMessage()]);
        }
    }

    public function SubmitDevelopmentOrderRevision(Request $request)
    {

        $uploadedFiles = $request->file('files');

        if ($uploadedFiles) {
            foreach ($uploadedFiles as $key => $file) {
                $fileName = $file->getClientOriginalName();
                $filePath = 'Uploads/Revision-Attachments/' . $request->Revision_ID . '/' . $fileName;
                $file->move(public_path('Uploads/Revision-Attachments/' . $request->Revision_ID . '/'), $fileName);
                SubmitRevisionAttachment::create([
                    'file_name' => $fileName,
                    'file_path' => $filePath,
                    'uploaded_by' => $request->upload_by,
                    'revision_id' => $request->Revision_ID,
                ]);
            }
            $OrderBasicInfo = DevelopmentOrderInfo::where('order_id', $request->Order_ID)
                ->update([
                    'Order_Status' => 2
                ]);

            if ($OrderBasicInfo) {
                $authUser = Auth::guard('Authorized')->user();
                $message = "The Order " . $request->Order_Number . " have Submit a Revision";
                PortalHelpers::sendNotification($request->Order_ID, null, $message, $authUser->designation->Designation_Name, [$authUser->id], [1,  9, 10, 11]);
                return back()->with('Success!', 'Revision Submited Successfully');
            } else {
                return back()->with('Error!', 'Revision Not Submited Sucessfully');
            }
        } else {
            return back()->with('Error!', 'File Not Submited Sucessfuyy');
        }
    }

    public function UpdateDevelopmentRevisionOrder(Request $request)
    {

        DB::beginTransaction();
        try {

            $Deadline = OrderSubmissionInfo::where('order_id', $request->Order_ID)->update([
                'DeadLine' => $request->DeadLine,
                'DeadLine_Time' => $request->DeadLine_Time
            ]);

            // Handle uploaded files
            $uploadedFiles = $request->file('files');
            if ($uploadedFiles) {
                foreach ($uploadedFiles as $key => $file) {
                    $fileName = $file->getClientOriginalName();
                    $filePath = 'Uploads/Revision-Attachments/' . $request->Revision_id . '/' . $fileName;

                    $file->move(public_path('Uploads/Revision-Attachments/' . $request->Revision_id . '/'), $fileName);

                    OrderRevisionAttachments::create([
                        'File_Name' => $fileName,
                        'File_Path' => $filePath,
                        'revision_id' => $request->Revision_id,
                    ]);
                }
            }
            // Commit the transaction
            DB::commit();
            $authUser = Auth::guard('Authorized')->user();
            $Order_Number = OrderInfo::select('Order_ID')->where('id', $request->Order_ID)->first();
            $message = $Order_Number->Order_ID . " Revision is updated from Sales";
            PortalHelpers::sendNotification($request->Order_ID, null, $message, $authUser->designation->Designation_Name, [$authUser->id], [1, 9, 10, 11]);
            return back()->with('Success!', 'Revision Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('Error!', 'Revision Not Updated Successfully');
        }
    }

    private function OrderRevision(Request $request, $DevelopementOrderInfo)
    {
        // dd($DesignOrderInfo);
        $DevelopementOrderInfo->update([
            'order_status' => 3,
        ]);
        $orderSubmissionInfo = OrderSubmissionInfo::where('order_id', $request->order_id)->first();
        $orderSubmissionInfo->update([
            'DeadLine' => $request->DeadLine,
            'DeadLine_Time' => $request->DeadLine_Time,
        ]);
        
        AssignDeadLine::where('order_id', $request->order_id)->update([
            'deadline_date' => $request->DeadLine,
            'deadline_time' =>  $request->DeadLine_Time,
        ]);
        $orderRevision = OrderRevision::create([
            'Order_Revision' => $request->input('Order_Revision'),
            'order_id' => $request->order_id,
            'revised_by' => $request->revised_by,
        ]);
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $fileName = $file->getClientOriginalName();
                $filePath = 'Uploads/Revision-Attachments/' . $request->Order_ID . '/' . $fileName;

                $file->move(public_path('Uploads/Revision-Attachments/' . $request->Order_ID), $fileName);

                OrderRevisionAttachments::create([
                    'File_Name' => $fileName,
                    'file_path' => $filePath,
                    'revision_id' => $orderRevision->id,
                ]);
            }
        }
        $Order_Info = OrderInfo::where('Order_ID', $request->Order_ID)->firstOrFail();
        $OrderAssig = OrderAssigningInfo::where('order_id', $request->order_id)->pluck('assign_id')->all();
        $flattenedAssignIds = Arr::flatten($OrderAssig);
        $authUser = Auth::guard('Authorized')->user();
        $message = $request->Order_ID . ' The Revision of Order has been Placed!';

        PortalHelpers::sendNotification(
            null,
            $request->Order_ID,
            $message,
            $authUser->designation->Designation_Name,
            [$Order_Info->assign_id, ...$flattenedAssignIds],
            [1, 9, 10, 11]
        );
        DB::commit();
        return back()->with('Success!', 'Order Revision Submitted!');
    }
}
