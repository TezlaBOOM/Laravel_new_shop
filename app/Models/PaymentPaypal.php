<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentPaypal extends Model
{
    use HasFactory;
    protected $fillable = [

        'user_id',
        'payment_status',


    ];

public function product()
    {
        return $this->belongsToMany(Product::class);
    }
}