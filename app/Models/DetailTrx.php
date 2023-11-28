<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTrx extends Model
{
    use HasFactory;

    protected $table = 'transaction_detail';
    protected $fillable = ['order_id', 'status_code', 'transaction_status', 'payment_type', 'transaction_time', 'bank', 'va_number', 'pdf_url'];
    protected $primaryKey = 'order_id';
    public $incrementing = false;

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'order_id', 'order_id');
    }
}

