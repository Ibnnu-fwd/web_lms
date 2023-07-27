<?php

namespace App\Models\Course;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourseAccessLog extends Model
{
    use HasFactory;

    public $table = 'user_course_access_logs';
    protected $fillable = [
        'user_id',
        'course_id',
        'course_chapter_id',
        'course_sub_chapter_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function courseChapter()
    {
        return $this->belongsTo(CourseChapter::class);
    }

    public function courseSubChapter()
    {
        return $this->belongsTo(CourseSubChapter::class);
    }
}
