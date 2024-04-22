<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Types extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    // table from mysql
    protected $table = 'types';

    protected $fillable = [
        'type',
        'subtype'
    ];

    public function products() {
        return $this->belongsToMany(Products::class);
    }
}
