<?php

namespace App\Models\Notice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeImages extends Model
{
    use HasFactory;
    protected $fillable = [
        'notice_id',
        'image',
    ];
 public function notice(){
    return $this->belongsTo(Notice::class,'notice_id');
 }
    
}
