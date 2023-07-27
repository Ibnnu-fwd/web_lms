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
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'fullname',
        'email',
        'password',
        'gender',
        'birthday',
        'phone',
        'job',
        'institution',
        'role',
        'status',
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
}
