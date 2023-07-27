<?php

namespace App\Models\Transaction;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentedCourse extends Model
{
    use HasFactory;

    public $table = 'rented_course';

    protected $fillable = [
        'detail_transaction_id',
        'customer_id',
        'rental_status',
        'expired_date',
        'renewal_date',
        'renewal_fee'
    ];

    public function detailTransaction()
    {
        return $this->belongsTo(DetailTransaction::class, 'detail_transaction_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
