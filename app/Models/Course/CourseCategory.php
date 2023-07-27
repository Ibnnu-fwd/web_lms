<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    use HasFactory;

    public    $table    = 'course_categories';
    protected $fillable = [
        'icon',
        'name',
    ];

    public function course()
    {
        return $this->hasMany(Course::class, 'category_id');
    }
}
