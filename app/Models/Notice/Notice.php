<?php

namespace App\Models\Notice;

use App\Events\NoticeCreated;
use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable = [
        'title',
        'type',
        'content',
        'created_by',
        'time_limit',
        'start_datetime',
        'end_datetime',
    ];
    use HasFactory;


    public function images()
    {
        return $this->hasMany(NoticeImages::class, 'notice_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function questions()
    {
        return $this->hasMany(SurveyQuestions::class, 'notice_id');
    }


    protected static function boot()
    {
        parent::boot();
    
        static::created(function ($notice) {
            event(new NoticeCreated($notice));
        });
    }

    
}
