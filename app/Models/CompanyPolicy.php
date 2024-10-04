<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class CompanyPolicy extends Model
{
    use HasFactory;
    protected $fillable = ['policy_path'];

    protected static function boot()
    {
        parent::boot();
        static::updated(function () {
            Cache::forget('company_policy');
        });
    }
}
