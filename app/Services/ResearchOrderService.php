<?php

namespace App\Services;

use App\Models\ResearchOrders\OrderInfo;
use App\Models\ResearchOrders\OrderTask;
use Illuminate\Http\Request;

class ResearchOrderService
{
    public function getOrderDetail($Order_ID, $Role_ID, $User_ID)
    {
        if ($Role_ID === 7 || $Role_ID === 6) {
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
                    'basic_info',
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
                        ])->withTrashed();
                    },
                    'tasks' => function ($q) use ($User_ID) {
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
                            'assign_dead_lines' => function ($q) use ($User_ID) {
                                $q->with('User.basic_info')->where('user_id', $User_ID);
                            },
                            'revision'
                        ])->where('assign_id', $User_ID);
                    }
                ])->firstOrFail();
        }

        if ($Role_ID === 5) {
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
                    'basic_info',
                    'submission_info',
                    'reference_info',
                    'order_desc',
                    'payment_info',
                    'attachments',
                    'final_submission',
                    'revision',
                    'assign' => function ($q) {
                        $q->with([
                            'basic_info' => function ($q) {
                                $q->select('id', 'F_Name', 'L_Name', 'user_id');
                            }
                        ]);
                    },
                    'tasks' => function ($q) use ($User_ID) {
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
                        ])->where('assign_by', $User_ID);
                    },
                    'assign_dead_lines' => function ($q) use ($User_ID) {
                        $q->with('User.basic_info')->where('user_id', $User_ID);
                    }
                ])->firstOrFail();
        }

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
                'basic_info',
                'submission_info',
                'reference_info',
                'order_desc',
                'payment_info',
                'attachments',
                'final_submission',
                'revision',
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
                },
                'assign_dead_lines' => function ($q) {
                    $q->with('User.basic_info');
                }
            ])->firstOrFail();
    }

    /**
     * @param $Role_ID
     * @param $User_ID
     * @return mixed|null
     */
    public function getOrdersList($Role_ID, $User_ID): mixed
    {
        $query = OrderInfo::orderBy('id', 'DESC')
            ->with([
                'authorized_user.basic_info' => function ($q) {
                    $q->select('id', 'F_Name', 'L_Name', 'user_id');
                },
                'client_info',
                'basic_info',
                'submission_info',
                'payment_info',
                'assign.basic_info' => function ($q) {
                    $q->select('id', 'F_Name', 'L_Name', 'user_id');
                },
            ])
            ->whereRelation('basic_info', function ($q) {
                $q->whereNot('Order_Status', 2);
            });

        return $this->getTaskList($Role_ID, $query, $User_ID);
    }

    public function getCompletedOrdersList($Role_ID, $User_ID): mixed
    {
        $query = OrderInfo::latest('id')
            ->with([
                'authorized_user.basic_info' => function ($q) {
                    $q->select('id', 'F_Name', 'L_Name', 'user_id');
                },
                'client_info',
                'basic_info',
                'submission_info',
                'payment_info',
                'assign.basic_info' => function ($q) {
                    $q->select('id', 'F_Name', 'L_Name', 'user_id');
                },
            ])
            ->whereRelation('basic_info', function ($q) {
                $q->where('Order_Status', 2);
            });

        if ($Role_ID === 5) {
            $query->whereHas('assign', function ($q) use ($User_ID) {
                $q->where('assign_id', $User_ID);
            });
        } elseif (in_array($Role_ID, [6, 7], true)) {
            $query = OrderTask::latest('id')
                ->with('order_info')
                ->whereHas('order_info')
                ->where('Task_Status', 2)
                ->where('assign_id', $User_ID);
        } else if (!in_array($Role_ID, [1, 9, 10, 11, 4], true)) {
            return null; // Invalid role ID
        }
        return $query->get();
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
                'basic_info',
                'submission_info',
                'payment_info',
                'assign.basic_info' => function ($q) {
                    $q->select('id', 'F_Name', 'L_Name', 'user_id');
                },
            ])->whereHas('basic_info');

        return $this->getTaskList($Role_ID, $query, $User_ID);
    }

    public function getDeadLineOrders($deadlineDate, int $Role_ID, int $User_ID, $flag)
    {
        $query = OrderInfo::latest('id')
            ->with([
                'authorized_user.basic_info' => function ($q) {
                    $q->select('id', 'F_Name', 'L_Name', 'user_id');
                },
                'client_info',
                'basic_info',
                'content_info',
                'submission_info',
                'payment_info',
                'assign.basic_info' => function ($q) {
                    $q->select('id', 'F_Name', 'L_Name', 'user_id');
                },
            ])
            ->where(function ($query) {
                $query->whereHas('basic_info', function ($q) {
                    $q->notCompleted();
                })->orWhereHas('content_info', function ($q) {
                    $q->notCompleted();
                });
            });

        $deadlineColumns = ['T_DeadLine', 'S_DeadLine', 'F_DeadLine', 'DeadLine'];

        foreach ($deadlineColumns as $column) {
            if ($flag === true) {
                $query->orWhereHas('submission_info', function ($q) use ($column, $deadlineDate) {
                    $q->orWhereDate($column, '<', $deadlineDate);
                });
            } elseif ($flag === false) {
                $query->orWhereHas('submission_info', function ($q) use ($column, $deadlineDate) {
                    $q->orWhereDate($column, '=', $deadlineDate);
                });
            } else {
                $query->orWhereHas('submission_info', function ($q) use ($column, $deadlineDate) {
                    $q->orWhereDate($column, '>', $deadlineDate);
                });
            }
        }

        return $this->getTaskListByDate($Role_ID, $query, $User_ID, $deadlineDate, $flag);
    }

    private function getTaskListByDate($Role_ID, $query, $User_ID, $deadlineDate, $flag)
    {
        if ($Role_ID === 5) {
            $query->whereHas('assign', function ($q) use ($User_ID) {
                $q->where('assign_id', $User_ID);
            });
        } elseif ($Role_ID === 8 || $Role_ID === 12) {
            $query->where('assign_id', $User_ID);
        } elseif (in_array($Role_ID, [6, 7], true)) {
            $query = OrderTask::latest('id')
                ->with('order_info')
                ->whereHas('order_info')
                ->whereNot('Task_Status', 2)
                ->where('assign_id', $User_ID);
            if ($flag === true) {
                $query->whereDate('DeadLine', '<', $deadlineDate);
            } else if ($flag === false) {
                $query->whereDate('DeadLine', '=', $deadlineDate);
            } else {
                $query->whereDate('DeadLine', '>', $deadlineDate);
            }
        } else if (!in_array($Role_ID, [1, 9, 10, 11, 4], true)) {
            return null; // Invalid role ID
        }
        return $query->get();
    }

    /**
     * @param $Role_ID
     * @param $query
     * @param $User_ID
     * @return null
     */
    private function getTaskList($Role_ID, $query, $User_ID)
    {
        if ($Role_ID === 5) {
            $query->whereHas('assign', function ($q) use ($User_ID) {
                $q->where('assign_id', $User_ID);
            });
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

    public function getThreeHoursDeadLineOrders($getDate, $getTime, $Role_ID, $User_ID)
    {
        if ($Role_ID === 1 || $Role_ID === 4 || $Role_ID === 9 || $Role_ID === 10 || $Role_ID === 11) {
            $Orders = OrderInfo::latest('id')
                ->with(['basic_info', 'content_info', 'submission_info'])
                ->whereHas('basic_info', function ($q) {
                    $q->where('Order_Status', '!=', 2);
                })
                ->orWhereHas('content_info', function ($q) {
                    $q->where('Order_Status', '!=', 2);
                })
                ->whereHas('submission_info', function ($q) use ($getDate, $getTime) {
                    $q->whereDate('DeadLine', $getDate)
                        ->whereTime('DeadLine_Time', '>=', $getTime);
                });
            return $Orders->get();
        }

        if ($Role_ID === 5) {
            $Orders = OrderInfo::latest('id')
                ->with(['basic_info', 'submission_info'])
                ->whereHas('basic_info', function ($q) {
                    $q->where('Order_Status', '!=', 2);
                })
                ->whereHas('submission_info', function ($q) use ($getDate, $getTime) {
                    $q->whereDate('DeadLine', $getDate)
                        ->whereTime('DeadLine_Time', '>=', $getTime);
                })->whereHas('assign', function ($q) use ($User_ID) {
                    $q->where('assign_id', $User_ID);
                });
            return $Orders->get();
        }

        if ($Role_ID === 6 || $Role_ID === 7) {
            $Orders = OrderTask::latest('id')
                ->whereDate('DeadLine', $getDate)
                ->whereTime('DeadLine_Time', '>=', $getTime)
                ->with('order_info')
                ->where('assign_id', $User_ID)
                ->where('Task_Status', '!=', 2);
            return $Orders->get();
        }

        if ($Role_ID === 12 || $Role_ID === 8) {
            $Orders = OrderInfo::latest('id')
                ->with(['content_info', 'submission_info'])
                ->orWhereHas('content_info', function ($q) {
                    $q->where('Order_Status', '!=', 2);
                })
                ->whereHas('submission_info', function ($q) use ($getDate, $getTime) {
                    $q->whereDate('DeadLine', $getDate)
                        ->whereTime('DeadLine_Time', '>=', $getTime);
                })->where('assign_id', $User_ID);
            return $Orders->get();
        }
        return null;
    }

    public function restoreOrder(Request $request): void
    {
        $Order = OrderInfo::withTrashed()->find($request->Order_ID);
        $Order->restore();
    }

    public function deleteOrder(Request $request): void
    {
        $Order = OrderInfo::withTrashed()->find($request->Order_ID);
        $Order->forceDelete();
    }
}
