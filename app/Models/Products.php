<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Products extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'desc',
        'image',
        'quantity',
        'price',
        'type_id',
        'subtype'
    ];

    public function types() {
        return $this->hasOne(Types::class);
    }

    public function orderProducts() {
        return $this->belongsToMany(OrderProduct::class);
    }

    public function shoppingCart() {
        return $this->belongsToMany(ShoppingCart::class);
    }
}
