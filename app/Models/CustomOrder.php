<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class CustomOrder extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'custom_orders';

    protected $fillable = [
        'name',
        'desc',
        'price',
        'quantity'
    ];

    // relation with the table users
    public function users() {
        return $this->belongsTo(User::class);
    }

    public function types() {
        return $this->hasOne(Types::class);
    }
}
