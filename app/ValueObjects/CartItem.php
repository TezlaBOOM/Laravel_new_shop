<?php

namespace App\ValueObjects;
use App\Models\Product;
class CartItem
{
    private int $productId;
    private string $name;
    private float $price;
    private int $quantity =0;
    private ?string $imagePath;

    public function __construct(Product $product, int $quantity = 1)
   {
       $this->productId = $product->id;
       $this->name = $product->name;
       $this->price = $product->price;
       $this->imagePath = $product->image_path;
       $this->quantity += $quantity;
   }

    public function getProductId(){
        return $this->productId;
    }

    public function getName(){
        return $this->name;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getquantity(){
        return $this->productId;
    }
    public function getSum(){
        return $this->price* $this->quantity;
    }
    public function getImage(){
        return !is_null($this->imagePath)? asset("storage/".$this->imagePath):config("shop.defaultImage");
    }

    public function addQuantity(Product $product)
    {
        return new CartItem($product, ++$this->quantity);
    }
    

}