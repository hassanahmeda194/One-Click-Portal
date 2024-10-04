<?php

namespace App\Models\Notice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyOptions extends Model
{
    use HasFactory;
    protected $fillable = ['question_id', 'option'];

   
    public function answers(){
        return $this->hasMany(SurveyAnswers::class, 'option_id');
    }
    
}