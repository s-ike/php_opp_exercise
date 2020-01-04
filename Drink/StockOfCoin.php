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
        if ($coin->typeEquals(Coin::ONE_HUNDRED)) {
            $this->number_of_100yen += $coin->getNumber();
        }
        if ($coin->typeEquals(Coin::FIVE_HUNDRED)) {
            $this->number_of_500yen += $coin->getNumber();
        }
    }

    public function isSmallNumberOf100yen(int $num) :bool
    {
        return $this->number_of_100yen < $num;
    }

    public function isSmallNumberOf500yen(int $num) :bool
    {
        return $this->number_of_500yen < $num;
    }

    public function reduceOne100yen() :void
    {
        $this->number_of_100yen--;
    }

    public function reduceOne500yen() :void
    {
        $this->number_of_500yen--;
    }

    public function takeOutChange() :?Coin
    {
        $count = (Coin::FIVE_HUNDRED - Coin::ONE_HUNDRED) / Coin::ONE_HUNDRED;
        if ($this->isSmallNumberOf100yen($count)) {
            return null;
        } else {
            $change = new Coin(Coin::ONE_HUNDRED, $count);
            for ($i = 0; $i < $count; $i++) {
                $this->reduceOne100yen();
            }
            return $change;
        }
    }
}
