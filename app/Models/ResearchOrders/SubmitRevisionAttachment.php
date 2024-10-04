<?php

namespace App\Models\ResearchOrders;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class SubmitRevisionAttachment extends Model
{
    use HasFactory;
    protected $table = "submit_revision_attachments" ;
    protected $fillable = [
        'file_name'  , 'file_path' , 'uploaded_by' , 'revision_id'
    ];


    public function Revision()
    {
        return $this->belongsTo(OrderRevision::class, 'revision_id', 'id');
    }
    
    public function UplodedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by', 'id');
    }



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
