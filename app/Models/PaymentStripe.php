<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStripe extends Model
{
    use HasFactory;
    protected $fillable = [           
        
        'user_id',
        'payment_status',   

        
    ];


    
    public function User()
    {
        return $this->hasOne(Payment::class);
    }
  

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }

}
