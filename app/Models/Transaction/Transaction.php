<?php

namespace App\Models\Transaction;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    const TRANSACTION_TYPE_REGISTER = 'register';
    const TRANSACTION_TYPE_BUY      = 'buy';
    const TRANSACTION_TYPE_RENEW    = 'renew';

    // TODO: add status order
    const STATUS_ORDER_WAITING = 0;
    const STATUS_ORDER_SUCCESS = 1;
    const STATUS_ORDER_REJECT  = 2;
    const STATUS_ORDER_CANCEL  = 3;

    const STATUS_PAYMENT_WAITING = 0;
    const STATUS_PAYMENT_PAID    = 1;
    const STATUS_PAYMENT_CONFIRM = 2;
    const STATUS_PAYMENT_DECLINE = 3;

    use HasFactory;

    public $table = 'transactions';

    protected $fillable = [
        'transaction_code',
        'transaction_type',
        'customer_id',
        'sub_total',
        'total_payment',
        'status_order',
        'status_payment',
        'payment_proof'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function detailTransaction()
    {
        return $this->hasMany(DetailTransaction::class, 'transaction_id');
    }

    public function getStatusPaymentLabel()
    {
        if ($this->status_payment == self::STATUS_PAYMENT_WAITING) {
            return 'Menunggu';
        } elseif ($this->status_payment == self::STATUS_PAYMENT_PAID) {
            return 'Dibayar';
        } elseif ($this->status_payment == self::STATUS_PAYMENT_CONFIRM) {
            return 'Dikonfirmasi';
        } elseif ($this->status_payment == self::STATUS_PAYMENT_DECLINE) {
            return 'Ditolak';
        }
    }

    public function getStatusOrderLabel()
    {
        if ($this->status_order == self::STATUS_ORDER_WAITING) {
            return 'Menunggu';
        } elseif ($this->status_order == self::STATUS_ORDER_SUCCESS) {
            return 'Berhasil';
        } elseif ($this->status_order == self::STATUS_ORDER_REJECT) {
            return 'Ditolak';
        } elseif ($this->status_order == self::STATUS_ORDER_CANCEL) {
            return 'Dibatalkan';
        }
    }
}
