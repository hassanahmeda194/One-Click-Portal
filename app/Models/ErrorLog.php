<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    use HasFactory;
    protected $table = "error_logs";

    public function createdAt(): Attribute
    {
        return new Attribute(
            get: fn($value) => date('F d, Y h:i:s A', strToTime($value)),
            set: fn($value) => $value,
        );
    }

    public function updatedAt(): Attribute
    {
        return new Attribute(
            get: fn($value) => date('F d, Y h:i:s A', strToTime($value)),
            set: fn($value) => $value,
        );
    }
}
