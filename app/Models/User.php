<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Course\UserCourseAccessLog;
use App\Models\Transaction\RentedCourse;
use App\Models\Transaction\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    const ROLE_ADMIN       = 1;
    const ROLE_INSTITUTION = 2;
    const ROLE_USER        = 3;

    const ROLE_ADMIN_LABEL       = 'Admin';
    const ROLE_VERIFICATOR_LABEL = 'Verifikator';
    const ROLE_INSTITUTION_LABEL = 'Institusi';
    const ROLE_USER_LABEL        = 'Personal';

    const STATUS_PENDING  = 0;
    const STATUS_ACTIVE   = 1;
    const STATUS_INACTIVE = 2;

    const STATUS_PENDING_LABEL  = 'Pending';
    const STATUS_ACTIVE_LABEL   = 'Aktif';
    const STATUS_INACTIVE_LABEL = 'Tidak Aktif';

    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'fullname',
        'email',
        'password',
        'gender',
        'birthday',
        'avatar',
        'phone',
        'job',
        'institution',
        'role',
        'status',
        'is_verificator'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public function courseAuthor()
    {
        return $this->hasMany(CourseAuthor::class, 'user_id');
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'customer_id', 'id');
    }

    public function rentedCourse()
    {
        return $this->hasMany(RentedCourse::class, 'customer_id', 'id');
    }

    public function userQuizAttempts()
    {
        return $this->hasMany(UserQuizAttempt::class);
    }

    public function userCourseAccessLogs()
    {
        return $this->hasMany(UserCourseAccessLog::class);
    }

    // Scope
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    // Custom Function
    public function getRoleLabel()
    {
        if ($this->is_verificator == true) {
            return self::ROLE_VERIFICATOR_LABEL;
        } else {
            switch ($this->role) {
                case self::ROLE_ADMIN:
                    return self::ROLE_ADMIN_LABEL;
                    break;
                case self::ROLE_INSTITUTION:
                    return self::ROLE_INSTITUTION_LABEL;
                    break;
                case self::ROLE_USER:
                    return self::ROLE_USER_LABEL;
                    break;
                default:
                    return 'Unknown';
                    break;
            }
        }
    }
}
