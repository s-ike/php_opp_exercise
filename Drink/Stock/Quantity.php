<?php
namespace Drink\Stock;

class Quantity
{
    private $amount;

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public function getAmount() :int
    {
        return $this->amount;
    }

    public function add(Quantity $quantity) :void
    {
        $this->amount += $quantity->getAmount();
    }

    public function reduce(Quantity $quantity) :void
    {
        $this->amount -= $quantity->getAmount();
    }

    public function toString() :string
    {
        return sprintf('%d個', $this->amount);
    }
}
