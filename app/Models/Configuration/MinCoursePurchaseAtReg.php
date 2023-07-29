<?php

namespace App\Models\Configuration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinCoursePurchaseAtReg extends Model
{
    use HasFactory;

    public    $table    = 'min_course_purchase_at_reg';
    protected $fillable = [
        'name',
        'value',
    ];
}
