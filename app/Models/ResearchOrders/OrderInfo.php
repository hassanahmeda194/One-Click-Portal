<?php

namespace App\Models\ResearchOrders;

use App\Models\AssignDeadLine;
use App\Models\Auth\User;
use App\Models\Chats\ResearchOrderChat;
use App\Models\ContentOrders\ContentBasicInfo;
use App\Models\DesignOrderInfo;
use App\Models\DevelopmentOrderInfo;
use App\Models\Draft\DraftSubmission;
use App\Models\Performance\UserWordsStats;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderInfo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "order_infos";
    protected $fillable = [
        'Order_ID',
        'Client_Type',
        'Order_Type',
        'user_id',
        'assign_id',
        'client_id'
    ];
    protected $dates = ['deleted_at'];

    public function authorized_user(): belongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function assign(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, OrderAssigningInfo::class, 'order_id', 'id', 'id', 'assign_id');
    }

    public function client_info(): belongsTo
    {
        return $this->belongsTo(OrderClientInfo::class, 'client_id', 'id');
    }

    public function basic_info(): HasOne
    {
        return $this->hasOne(OrderBasicInfo::class, 'order_id', 'id');
    }

    public function content_info(): HasOne
    {
        return $this->hasOne(ContentBasicInfo::class, 'order_id', 'id');
    }

    public function submission_info(): HasOne
    {
        return $this->hasOne(OrderSubmissionInfo::class, 'order_id', 'id');
    }

    public function deadlines(): HasMany
    {
        return $this->hasMany(ResearchOrderSubmissionDeadline::class, 'order_id');
    }

    public function reference_info(): HasOne
    {
        return $this->hasOne(OrderReferenceInfo::class, 'order_id', 'id');
    }

    public function order_desc(): HasOne
    {
        return $this->hasOne(OrderDescriptionInfo::class, 'order_id', 'id');
    }

    public function payment_info(): HasOne
    {
        return $this->hasOne(OrderPaymentInfo::class, 'order_id', 'id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(OrderAttachment::class, 'order_id', 'id');
    }

    public function revision(): HasMany
    {
        return $this->hasMany(OrderRevision::class, 'order_id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(OrderTask::class, 'order_id');
    }

    public function final_submission(): HasMany
    {
        return $this->hasMany(FinalOrderSubmission::class, 'order_id', 'id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(ResearchOrderChat::class, 'order_id', 'id');
    }

    public function stats(): HasOne
    {
        return $this->hasOne(UserWordsStats::class, 'order_id');
    }
    public function draftSubmissions(): HasMany
    {
        return $this->hasMany(DraftSubmission::class, 'order_id', 'id');
    }

    public function design_info()
    {
        return $this->hasOne(DesignOrderInfo::class, 'order_id');
    }

    public function development_info()
    {
        return $this->hasOne(DevelopmentOrderInfo::class, 'order_id');
    }

    public function assign_dead_lines(): HasMany
    {
        return $this->hasMany(AssignDeadLine::class, 'order_id');
    }
}
