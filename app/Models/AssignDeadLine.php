<?php

namespace App\Models;

use App\Models\Auth\User;
use App\Models\ResearchOrders\OrderInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssignDeadLine extends Model
{
    use HasFactory;
    protected $table = 'assign_dead_lines';
    protected $fillable = [
        'deadline_date',
        'deadline_time',
        'first_draft',
        'second_draft',
        'third_draft',
        'forth_draft',
        'fifth_draft',
        'sixth_draft',
        'seventh_draft',
        'eighth_draft',
        'nineth_draft',
        'tenth_draft',
        'eleventh_draft',
        'twelveth_draft',
        'thirteen_draft',
        'fourteen_draft',
        'fifteen_draft',
        'user_id',
        'order_id',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Order(): BelongsTo
    {
        return $this->belongsTo(OrderInfo::class, 'order_id');
    }
}
