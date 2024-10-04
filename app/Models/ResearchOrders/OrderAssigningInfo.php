<?php

namespace App\Models\ResearchOrders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAssigningInfo extends Model
{
    use HasFactory;
    protected $table = "order_assigning_infos";
    protected $fillable = [
        'order_id',
        'assign_id',
    ];
    

    
}
