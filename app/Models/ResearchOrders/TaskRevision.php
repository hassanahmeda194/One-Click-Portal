<?php

namespace App\Models\ResearchOrders;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskRevision extends Model
{
    use HasFactory;
    protected $table = "task_revisions";
    protected $fillable = [
        'Task_Revision',
        'task_id',
        'revised_by'
    ];

    public function revision_by():belongsTo
    {
        return $this->belongsTo(User::class, 'revised_by');
    }

    public function task():belongsTo
    {
        return $this->belongsTo(OrderTask::class, 'task_id');
    }

    public function attachments():HasMany
    {
        return $this->hasMany(RevisionAttachments::class, 'revision_id');
    }

    // User DB Attribute

    public function createdAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('F d, Y H:i:s A', strToTime($value)),
            set: fn ($value) => $value,
        );
    }

    public function updatedAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('F d, Y H:i:s A', strToTime($value)),
            set: fn ($value) => $value,
        );
    }
}
