<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignOrderInfo extends Model
{
    use HasFactory;
    protected $table = 'design_order_infos';
    protected $fillable = [
        'project_title',
        'project_service',
        'primary_color_palette',
        'secondary_Color_palette',
        'font_name',
        'size_of_design',
        'delivery_formate',
        'source_file',
        'video_type',
        'duration',
        'website_order',
        'order_status',
        'order_id',
    ];

    

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
