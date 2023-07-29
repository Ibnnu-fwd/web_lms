<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseObjective extends Model
{
    use HasFactory;

    public $table = 'course_objectives';
    protected $fillable = [
        'course_id',
        'title',
        'description',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
