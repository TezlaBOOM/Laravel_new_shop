<?php

namespace App\Dtos\Cart;

class CartDtos
{
  private array $items = [];
  private float $totalSum = 0 ;
  private int $totalQuantity = 0 ;


  /**
   * @return array
   */
public function getItem(): array
{
    return $this->items;
}

/**
 * 
 */

 public function setItems(array $items)
 {
    $this->items = $items;
 }

 /**
  * 
  */

 public function getTotalSum()
 {
    return $this->totalSum;
 }

 /**
  * 
  */
  public function setTotalSum(float|int $totalSum)
  {
    $this->totalSum = $totalSum;
  }

 /**
  * 
  */
public function getTotalQuantity()
{
    return $this->totalQuantity;
}


/**
 * 
 */
public function setTotalQuantity(int $totalQuantity)
{
    $this->totalQuantity = $totalQuantity;
}
public function incerementtotalQuantity(){
    $this->totalQuantity +=1;
}
public function incerementtotalSum(float $price){
    $this->totalSum +=$price;
}
}
