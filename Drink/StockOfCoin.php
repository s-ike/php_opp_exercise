<?php
namespace Drink;

class StockOfCoin
{
    private static $instance = null;
    private $number_of_500yen = 0;
    private $number_of_100yen = 0;

    private function __construct(array $coins)
    {
        foreach ($coins as $coin) {
            $this->add($coin);
        }
    }

    public static function getInstance(array $coins)
    {
        if (self::$instance) {
            return self::$instance;
        }
        self::$instance = new StockOfCoin($coins);
        return self::$instance;
    }

    public function add(Coin $coin) :void
    {
        if ($coin->getType() === Coin::ONE_HUNDRED) {
            $this->number_of_100yen += $coin->getNumber();
        }
        if ($coin->getType() === Coin::FIVE_HUNDRED) {
            $this->number_of_500yen += $coin->getNumber();
        }
    }

    public function getNumberOf100yen() :int
    {
        return $this->number_of_100yen;
    }

    public function getNumberOf500yen() :int
    {
        return $this->number_of_500yen;
    }

    public function reduceOne100yen() :void
    {
        $this->number_of_100yen--;
    }

    public function reduceOne500yen() :void
    {
        $this->number_of_500yen--;
    }
}
