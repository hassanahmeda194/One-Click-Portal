<?php

namespace App\Models\BasicModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCurrencies extends Model
{
    use HasFactory;
    protected $table = "order_currencies";
}
