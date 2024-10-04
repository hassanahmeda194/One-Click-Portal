<?php

namespace App\Models\Draft;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class DraftSubmission extends Model
{
    use HasFactory;
    protected $table = 'draft_submission';

    protected $fillable = ['order_id', 'order_number', 'submitted_by', 'draft_number'];


    public function attachments()
    {
        return $this->hasMany(DraftAttachment::class, 'Draft_submission_id', 'id');
    }

    
    public function submittedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by')->withTrashed();
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
