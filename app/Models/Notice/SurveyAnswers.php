<?php

namespace App\Models\Notice;

use App\Models\Auth\User;
use App\Models\Notice\SurveyQuestions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyAnswers extends Model
{
    use HasFactory;

    protected $fillable = ['question_id', 'user_id', 'option_id'];

    public function question()
    {
        return $this->belongsTo(SurveyQuestions::class, 'question_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
