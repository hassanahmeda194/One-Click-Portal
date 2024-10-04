<?php

namespace App\Models\Draft;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftAttachment extends Model
{
    use HasFactory;
    protected $table = 'draft_attachment';

    protected $fillable = ['File_Name', 'File_Path', 'Draft_submission_id'];


    public function submission()
    {
        return $this->belongsTo(DraftSubmission::class, 'Draft_submission_id', 'id');
    }


    public function createdAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('F d, Y', strToTime($value)),
            set: fn ($value) => $value,
        );
    }

    public function updatedAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('F d, Y', strToTime($value)),
            set: fn ($value) => $value,
        );
    }
}
