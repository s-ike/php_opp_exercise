<?php
namespace Drink;

class StockOfDrink
{
    private $quantity;

    public function __construct(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function getQuantity() :int
    {
        return $this->quantity;
    }

    public function decrement() :void
    {
        $this->$quantity--;
    }
}
