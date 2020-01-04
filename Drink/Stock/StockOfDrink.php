<?php
namespace Drink\Stock;

class StockOfDrink
{
    private $quantity;

    public function __construct(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function isEmpty() :bool
    {
        return $this->quantity === 0;
    }

    public function decrement() :void
    {
        $this->quantity = --$this->quantity;
    }

    public function getQuantity() :int
    {
        return $this->quantity;
    }
}
