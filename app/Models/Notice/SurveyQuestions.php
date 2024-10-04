<?php

namespace App\Models\Notice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyQuestions extends Model
{
    use HasFactory;

    protected $fillable = ['notice_id', 'question'];

    public function notice()
    {
        return $this->belongsTo(Notice::class, 'notice_id');
    }



    public function options()
    {
        return $this->hasMany(SurveyOptions::class, 'question_id');
    }

}
