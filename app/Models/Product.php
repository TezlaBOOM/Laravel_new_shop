<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'image_path',
        'name',     
        'sku',   
        'description',
        'amount',
        'price',
        'category_id',
        
    ];


    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }


    public function isSelectedCategory(int $category_id)
    {
        return $this->hasCategory() && $this->category->id == $category_id; 
    }
    public function hasCategory()
    {
        return !is_null($this->category);
    }
    public function paypals()
    {
        return $this->belongsToMany(PaymentPaypal::class);
    }
}
