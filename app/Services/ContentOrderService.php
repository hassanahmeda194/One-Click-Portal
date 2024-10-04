<?php

namespace App\Services;

use App\Models\Auth\User;
use App\Models\ResearchOrders\OrderInfo;
use App\Models\ResearchOrders\OrderTask;
use Illuminate\Database\Eloquent\Collection;

class ContentOrderService
{
    public function getOrderDetail($Order_ID)
    {
        return OrderInfo::where('Order_ID', $Order_ID)
            ->with([
                'authorized_user' => function ($q) {
                    $q->with([
                        'basic_info' => function ($q1) {
                            $q1->select('id', 'F_Name', 'L_Name', 'user_id');
                        }
                    ]);
                },
                'client_info',
                'content_info',
                'submission_info',
                'reference_info',
                'order_desc',
                'payment_info',
                'attachments',
                'final_submission',
                'revision',
                'deadlines',
                'assign' => function ($q) {
                    $q->with([
                        'basic_info' => function ($q) {
                            $q->select('id', 'F_Name', 'L_Name', 'user_id');
                        }
                    ]);
                },
                'tasks' => function ($q) {
                    $q->with([
                        'assign' => function ($q) {
                            $q->with([
                                'basic_info' => function ($q) {
                                    $q->select('id', 'F_Name', 'L_Name', 'user_id');
                                }
                            ]);
                        },
                        'assign_by' => function ($q) {
                            $q->with([
                                'basic_info' => function ($q) {
                                    $q->select('id', 'F_Name', 'L_Name', 'user_id');
                                }
                            ]);
                        },
                        'submit_info' => function ($q) {
                            $q->with([
                                'submitted' => function ($q) {
                                    $q->with([
                                        'basic_info' => function ($q) {
                                            $q->select('id', 'F_Name', 'L_Name', 'user_id');
                                        }
                                    ]);
                                }
                            ]);
                        },
                        'revision'
                    ]);
                }
            ])->firstOrFail();
    }

    public function getOrdersList($Role_ID, $User_ID): mixed
    {
        $query = OrderInfo::latest('id')
            ->with([
                'authorized_user.basic_info' => function ($q) {
                    $q->select('id', 'F_Name', 'L_Name', 'user_id');
                },
                'client_info',
                'content_info',
                'submission_info',
                'payment_info',
                'assign.basic_info' => function ($q) {
                    $q->select('id', 'F_Name', 'L_Name', 'user_id');
                },
            ])
            ->whereRelation('content_info', function ($q) {
                $q->whereNot('Order_Status', 2);
            });

        if ($Role_ID === 8 || $Role_ID === 12) {
            $query->where('assign_id', $User_ID);
        } elseif (in_array($Role_ID, [6, 7], true)) {
            $query = OrderTask::orderBy('id', 'DESC')
                ->with('order_info')
                ->whereHas('order_info')
                ->whereNot('Task_Status', 2)
                ->where('assign_id', $User_ID);
        } else if (!in_array($Role_ID, [1, 9, 10, 11, 17], true)) {
            return null; // Invalid role ID
        }
        return $query->get();
    }

    public function getCompletedOrdersList($Role_ID, $User_ID): mixed
    {
        $query = OrderInfo::latest('id')
            ->with([
                'authorized_user.basic_info' => function ($q) {
                    $q->select('id', 'F_Name', 'L_Name', 'user_id');
                },
                'client_info',
                'content_info',
                'submission_info',
                'payment_info',
                'assign.basic_info' => function ($q) {
                    $q->select('id', 'F_Name', 'L_Name', 'user_id');
                },
            ])
            ->whereRelation('content_info', function ($q) {
                $q->where('Order_Status', 2);
            });

        if ($Role_ID === 8 || $Role_ID === 12) {
            $query->where('assign_id', $User_ID);
        } elseif (in_array($Role_ID, [6, 7], true)) {
            $query = OrderTask::orderBy('id', 'DESC')
                ->with('order_info')
                ->whereHas('order_info')
                ->where('Task_Status', 2)
                ->where('assign_id', $User_ID);
        } else if (!in_array($Role_ID, [1, 9, 10, 11, 4, 17], true)) {
            return null; // Invalid role ID
        }
        return $query->get();
    }

    public function getContentWriters(): Collection|array
    {
        return User::with([
            'basic_info:id,user_id,F_Name,L_Name',
            'skills:id,Skill_Name'
        ])->select('id', 'EMP_ID', 'Role_ID', 'Skill_ID')
            ->whereHas('skills')
            ->get();
    }

    public function getDeletedOrdersList($Role_ID, $User_ID): mixed
    {
        $query = OrderInfo::onlyTrashed()
            ->latest('id')
            ->with([
                'authorized_user.basic_info' => function ($q) {
                    $q->select('id', 'F_Name', 'L_Name', 'user_id');
                },
                'client_info',
                'content_info',
                'submission_info',
                'payment_info',
                'assign.basic_info' => function ($q) {
                    $q->select('id', 'F_Name', 'L_Name', 'user_id');
                },
            ])->whereHas('content_info');

        if ($Role_ID === 8 || $Role_ID === 12) {
            $query->where('assign_id', $User_ID);
        } elseif (in_array($Role_ID, [6, 7], true)) {
            $query = OrderTask::orderBy('id', 'DESC')
                ->with('order_info')
                ->whereHas('order_info')
                ->whereNot('Task_Status', 2)
                ->where('assign_id', $User_ID);
        } else if (!in_array($Role_ID, [1, 9, 10, 11, 4], true)) {
            return null; // Invalid role ID
        }
        return $query->get();
    }
}
