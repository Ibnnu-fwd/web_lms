<?php

namespace App\Models\Transaction;

use App\Models\Course\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    use HasFactory;

    public $table = 'detail_transactions';

    protected $fillable = [
        'transaction_id',
        'course_id',
        'start_date',
        'end_date',
        'total_month',
        'sub_total',
        'total_payment',
        'customer_id'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function rentedCourse()
    {
        return $this->hasOne(RentedCourse::class, 'detail_transaction_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
