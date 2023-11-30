<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use HasFactory, SoftDeletes, Notifiable, CanResetPassword;

    protected $fillable = ['id', 'username', 'name', 'password', 'phone', 'email', 'address', 'image_profile', 'province_id', 'city_id', 'zip_code'];

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];    

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'customer_id', 'id');
    }
}
