<?php

namespace App\Models;

use App\Models\Course\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    public $table = 'discounts';

    protected $fillable = [
        'role',
        'course_id',
        'discount_price',
        'start_date',
        'end_date',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
