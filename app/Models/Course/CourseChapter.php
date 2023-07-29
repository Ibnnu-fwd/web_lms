<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseChapter extends Model
{
    use HasFactory;

    public $table = 'course_chapters';
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'is_active'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function courseSubChapters()
    {
        return $this->hasMany(CourseSubChapter::class);
    }

    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }

    public function userCourseAccessLogs()
    {
        return $this->hasMany(UserCourseAccessLog::class);
    }
}
