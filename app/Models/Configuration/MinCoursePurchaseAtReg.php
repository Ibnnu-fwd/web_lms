<?php

namespace App\Models\Configuration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinCoursePurchaseAtReg extends Model
{
    use HasFactory;
<<<<<<< Updated upstream

    public    $table    = 'min_course_purchase_at_reg';
=======
    public $table = 'min_course_purchase_at_reg';
>>>>>>> Stashed changes
    protected $fillable = [
        'name',
        'value',
    ];
}
