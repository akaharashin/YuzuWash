<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    function transaction() {
        return $this->hasMany(Order::class);
    }

    function order() {
        return $this->hasMany(Order::class);
    }

    function user() {
        return $this->belongsTo(User::class);
    }
}
