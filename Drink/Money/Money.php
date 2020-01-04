<?php
namespace Drink\Money;

class Money
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

    public function add(Money $money) :void
    {
        $this->amount += $money->getAmount();
    }

    public function toString() :string
    {
        return sprintf('%d円', $this->amount);
    }
}
