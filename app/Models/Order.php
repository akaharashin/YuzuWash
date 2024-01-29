<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    function product() {
        return $this->belongsTo(Product::class);
    }

    function transaction() {
        return $this->hasMany(Transaction::class);
    }
}
