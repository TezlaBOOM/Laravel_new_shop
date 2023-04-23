<?php

namespace App\Dtos\Cart;

class CartDto
{
  private array $item = [];
  private float $totalSum = 0 ;
  private int $totalQuantity = 0 ;


  /**
   * @return array
   */
public function getItems(): array
{
    return $this->item;
}

/**
 * 
 */

 public function setItems(array $item)
 {
    $this->item = $item;
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
public function incrementtotalQuantity(){
    $this->totalQuantity +=1;
}
public function incrementtotalSum(float $price){
    $this->totalSum +=$price;
}
}