<?php

namespace App\Models\Course\Quiz;

use App\Models\Course\CourseChapter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    public $table = 'quizzes';
    protected $fillable = [
        'course_chapter_id',
        'title',
        'description',
        'is_active'
    ];

    public function courseChapter()
    {
        return $this->belongsTo(CourseChapter::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function userQuizAttempts()
    {
        return $this->hasMany(UserQuizAttempt::class);
    }
}
