<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Users extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'users';

    // everyone must be filled
    protected $fillable = [
        'name',
        'surname',
        'email',
        'dni',
        'password',
        'type'
    ];

    // hidden fields
    protected $hidden = [
        'password',
    ];

    // relation with the table orders
    
    public function orders() {
        return $this->hasMany(Orders::class);
    }

    public function customOrders() {
        return $this->hasMany(CustomOrder::class);
    }

    public function shoppingCart() {
        return $this->hasMany(ShoppingCart::class);
    }
}
