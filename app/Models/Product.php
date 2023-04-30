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
        'description',
        'amount',
        'price',
        'category_id',
    ];
    public function category()
    {
        return $this->belongsTo(Order::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Product::class);
    }
    public function isSelectedCategory(int $category_id)
    {
        return $this->hasCategory() && $this->category->id == $category_id; 
    }
}
