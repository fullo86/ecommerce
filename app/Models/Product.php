<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id', 'product_code', 'product_name', 'price', 'description', 'weight', 'image_product1', 'image_product2', 'image_product3'];

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_size', 'product_id', 'size_id');
    }

    public function getImageProduct1Attributea()
    {
        return asset('storage/images/product/' . $this->attributes['image_product1']);
    }

    public function transaction()
    {
        return $this->belongsToMany(Transaction::class, 'product_transaction', 'transaction_id', 'product_id')->withPivot('qty');
    }
}
