<?php

namespace App\Models\Auth;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Attendance\Attendance;
use App\Models\BasicModels\UserDesignations;
use App\Models\BasicModels\WriterSkills;
use App\Models\LeaveEntitlements\LeaveRequest;
use App\Models\LeaveEntitlements\UserLeaveQuota;
use App\Models\Performance\UserWordsStats;
use App\Models\Performance\WriterPerformance;
use App\Models\ResearchOrders\OrderAssigningInfo;
use App\Models\ResearchOrders\OrderInfo;
use App\Models\ResearchOrders\OrderTask;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    protected $guard = 'Authorized';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'EMP_ID',
        'email',
        'password',
        'Role_ID',
        'CID',
        'Skill_ID',
        'created_by'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $dates = ['deleted_at'];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Users Relations

    public function createdBy(): belongsTo
    {
        return $this->belongsTo(__CLASS__, 'created_by')->withTrashed();
    }

    public function users(): HasMany
    {
        return $this->hasMany(__CLASS__, 'created_by');
    }

    public function designation(): belongsTo
    {
        return $this->belongsTo(UserDesignations::class, 'Role_ID');
    }

    public function basic_info(): HasOne
    {
        return $this->hasOne(UserBasicInfo::class, 'user_id');
    }

    public function emergency(): HasMany
    {
        return $this->hasMany(UserEmergencyInfo::class, 'user_id');
    }

    public function timing(): HasOne
    {
        return $this->hasOne(UserOfficeTiming::class, 'user_id');
    }

    public function leaves(): HasOne
    {
        return $this->hasOne(UserLeaveInfo::class, 'user_id');
    }

    public function bank_detail(): HasOne
    {
        return $this->hasOne(UserBankDetails::class, 'user_id');
    }

    public function permissons(): HasMany
    {
        return $this->hasMany(UserBasicPermisson::class, 'user_id');
    }

    public function other_permissons(): HasMany
    {
        return $this->hasMany(UserEmergencyInfo::class, 'user_id');
    }

    // Orders Relations
    public function research_orders(): HasManyThrough
    {
        return $this->hasManyThrough(OrderInfo::class, OrderAssigningInfo::class, 'assign_id', 'id', 'id', 'order_id');
    }

    public function stats(): HasMany
    {
        return $this->hasMany(UserWordsStats::class, 'user_id');
    }

    public function assign_task(): HasMany
    {
        return $this->hasMany(OrderTask::class, 'assign_id');
    }

    public function writers(): HasMany
    {
        return $this->hasMany(__CLASS__, 'CID');
    }

    public function skills(): belongsTo
    {
        return $this->belongsTo(WriterSkills::class, 'Skill_ID');
    }

    public function login_history(): HasMany
    {
        return $this->hasMany(LoginHistory::class, 'user_id');
    }

    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class, 'user_id');
    }

    public function leave(): HasMany
    {
        return $this->hasMany(LeaveRequest::class, 'user_id');
    }

    public function leave_quota(): HasOne
    {
        return $this->hasOne(UserLeaveQuota::class, 'user_id');
    }

    public function bench_mark(): HasMany
    {
        return $this->hasMany(UserBenchMark::class, 'user_id');
    }
    public function orderInfos(): HasMany
    {
        return $this->hasMany(OrderInfo::class, 'assign_id');
    }

    public function performance()
    {
        return $this->hasMany(WriterPerformance::class, 'user_id');
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
