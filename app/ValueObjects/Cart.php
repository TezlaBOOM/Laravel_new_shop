<?php

namespace App\ValueObjects;
use Illuminate\Support\Collection;
use App\Models\Product;
use Closure;
class Cart
{
  private Collection $items;

public function __construct(Collection $items = null)
{
    $this->items = $items ?? Collection::empty();
}
public function getItems()
{
    return $this->items;
}
public function addItem(Product $product){
  $items = $this->items;
  $item = $items->first($this->isProductIdSameAsItemProduct($product));
  if(!is_null($item)){
    $items = $items->reject($this->isProductIdSameAsItemProduct($product));
      $newItem = $item->addQuantity($product);
  }else{
      $newItem = new CartItem($product);
    }
    $items->add($newItem);
  return new Cart($items);
}
private function isProductIdSameAsItemProduct(Product $product)
{
  return function ($item) use ($product){
    return $product->id == $item->getProductId();
  };
  
}
}



 