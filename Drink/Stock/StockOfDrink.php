<?php
namespace Drink\Stock;

class StockOfDrink
{
    private $quantity;

    public function __construct(int $quantity)
    {
        $this->quantity = new Quantity($quantity);
    }

    public function isEmpty() :bool
    {
        return $this->quantity->getAmount() === 0;
    }

    public function decrement() :void
    {
        $one = new Quantity(1);
        $this->quantity->reduce($one);
    }

    public function getQuantity() :Quantity
    {
        return $this->quantity;
    }
}
