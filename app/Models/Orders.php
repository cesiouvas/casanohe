<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Orders extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'orders';

    protected $fillable = [
        'totalPrice',
        'address'
    ];

    // relation with the table users
    public function users() {
        return $this->belongsTo(Users::class);
    }

    public function orderProducts() {
        return $this->hasMany(OrderProduct::class);
    }
}
