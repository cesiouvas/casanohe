<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class OrderProduct extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'order_product';

    protected $fillable = [
        'quantity',
        'product_id',
        'order_id'
    ];

    public function orders() {
        return $this->belongsToMany(Orders::class);
    }

    public function products() {
        return $this->hasMany(Products::class);
    }
}
