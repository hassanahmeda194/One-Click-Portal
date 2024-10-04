<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoginHistory extends Model
{
    use HasFactory;
    protected $table = "login_histories";
    protected $fillable = ['user_id','ip_address'];
    public function users():belongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
