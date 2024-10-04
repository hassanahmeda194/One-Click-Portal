<?php

namespace App\Models\ResearchOrders;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RevisionAttachments extends Model
{
    use HasFactory;
    protected $table = "revision_attachments";
    protected $fillable = [
        'File_Name',
        'file_path',
        'revision_id'
        
    ];
    public function revision():belongsTo
    {
        return $this->belongsTo(TaskRevision::class, 'revision_id');
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
