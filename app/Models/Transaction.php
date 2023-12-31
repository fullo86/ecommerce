<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id', 'customer_id', 'recipient_name', 'phone', 'email', 'address', 'city_id', 'zip_code', 'order_id', 'total_price'];

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_transaction', 'transaction_id', 'product_id')->withPivot(['qty', 'size', 'ship_cost'])->withTimestamps();
    }

    public function detailTrx()
    {
        return $this->hasOne(DetailTrx::class, 'order_id', 'order_id');
    }
}
