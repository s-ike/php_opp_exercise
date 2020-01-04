<?php
namespace Drink;

class Change
{
    private $coins;

    public function __construct()
    {
        $this->coins = [];
    }

    public function add(Coin $coin) :void
    {
        $this->coins[] = $coin;
    }

    public function toMoney() :Money
    {
        $result = new Money(0);
        foreach ($this->coins as $coin) {
            $result->add($coin->toMoney());
        }
        return $result;
    }

    public function clear() :void
    {
        $this->coins = [];
    }
}
