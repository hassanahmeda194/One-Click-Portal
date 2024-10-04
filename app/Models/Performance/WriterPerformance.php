<?php

namespace App\Models\Performance;

use App\Models\Auth\User;
use App\Models\ResearchOrders\OrderInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class WriterPerformance extends Model
{
    use HasFactory;
    protected $fillable = ['achieved_word', 'cancel_word', 'user_id', 'order_id'];

    public function order_info()
    {
        return $this->belongsTo(OrderInfo::class, 'order_id');
    }
}
