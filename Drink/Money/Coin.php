<?php
namespace Drink\Money;

class Coin
{
    const ONE_HUNDRED = 100;
    const FIVE_HUNDRED = 500;

    private $type;
    private $number;

    public function __construct(int $type, int $number)
    {
        $this->type = $type;
        $this->number = $number;
    }

    public function addNumber(int $number) :void
    {
        $this->number += $number;
    }

    public function typeEquals(int $type) :bool
    {
        return $this->type === $type;
    }

    public function is100yen() :bool
    {
        return $this->type === Coin::ONE_HUNDRED;
    }

    public function is500yen() :bool
    {
        return $this->type === Coin::FIVE_HUNDRED;
    }

    public function getNumber() :int
    {
        return $this->number;
    }

    public function toMoney() :Money
    {
        return new Money($this->type * $this->number);
    }
}
