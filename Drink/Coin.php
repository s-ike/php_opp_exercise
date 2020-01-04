<?php
namespace Drink;

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

    public function addNumber(int $number)
    {
        $this->number += $number;
    }

    public function getNumber() :int
    {
        return $this->number;
    }

    public function getType() :int
    {
        return $this->type;
    }

    public function getAmount() :int
    {
        return $this->type * $this->number;
    }
}
