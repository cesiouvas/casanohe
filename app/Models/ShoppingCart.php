<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ShoppingCart extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'shoppingCart';

    protected $fillable = [
        'quantity'
    ];

    // relation with the table users
    public function users() {
        return $this->belongsTo(Users::class);
    }

    public function products() {
        return $this->hasMany(Products::class);
    }
}
