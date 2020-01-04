<?php
namespace Drink;

class Change
{
    private $coins;

    public function __construct()
    {
        $this->coins = [];
    }

    public function add(Coin $coin)
    {
        $this->coins[] = $coin;
    }

    public function getAmount() :int
    {
        $result = 0;
        foreach ($this->coins as $coin) {
            $result += $coin->getAmount();
        }
        return $result;
    }

    public function clear()
    {
        $this->coins = [];
    }
}
