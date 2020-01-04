<?php
namespace Drink;

class Payment
{
    private $coin;

    public function __construct(Coin $coin)
    {
        $this->coin = $coin;
    }

    public function needChange()
    {
        return $this->coin->is500yen();
    }

    public function is100yen()
    {
        return $this->coin->is100yen();
    }

    public function is500yen()
    {
        return $this->coin->is500yen();
    }

    public function get100yen() :?Coin
    {
        if ($this->is100yen()) {
            return $this->coin;
        }
        return null;
    }
}
