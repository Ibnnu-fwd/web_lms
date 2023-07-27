<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseTechSpec extends Model
{
    use HasFactory;

    public $table = 'course_tech_specs';
    protected $fillable = [
        'course_id',
        'name'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
