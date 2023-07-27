<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSubChapter extends Model
{
    use HasFactory;

    public $table = 'course_sub_chapters';
    protected $fillable = [
        'course_chapter_id',
        'title',
        'file',
        'video',
    ];

    public function courseChapter()
    {
        return $this->belongsTo(CourseChapter::class);
    }

    public function userCourseAccessLogs()
    {
        return $this->hasMany(UserCourseAccessLog::class);
    }
}
