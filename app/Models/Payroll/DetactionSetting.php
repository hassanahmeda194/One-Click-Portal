<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetactionSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'name' , 'detact_amount'
    ];
}
