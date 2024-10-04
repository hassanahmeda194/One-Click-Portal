<?php

namespace App\Models\ResearchOrders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;


class OrderRevisonWord extends Model
{
    use HasFactory;
    protected $table = "order_revison_words";
    protected $fillable = [
       'Revision_Words','Revision_ID'
    ];


    public function Revision(): belongsTo
    {
        return $this->belongsTo(OrderRevision::class, 'Revision_ID');
    }



    // User DB Attribute
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
