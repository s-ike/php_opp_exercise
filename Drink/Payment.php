<?php
namespace Drink;

class Payment
{
    private $change;
    private $coin;

    public function __construct(Coin $coin)
    {
        $this->change = new Change();
        $this->coin = $coin;
    }

    public function commit(CashBox $cash_box) :void
    {
        if ($this->coin->is100yen()) {
            // 100円玉を釣り銭に使える
            $this->change->add($this->coin);
        }
        if ($this->coin->is500yen()) {
            // 400円のお釣り
            $this->change->add($cash_box->takeOutChange());
        }
        $this->coin = null;
    }

    public function refund() :Money
    {
        $money = $this->change->toMoney();
        $this->change->clear();
        return $money;
    }

    public function needChange() :bool
    {
        return $this->coin->is500yen();
    }

    public function is100yen() :bool
    {
        return $this->coin->is100yen();
    }

    public function is500yen() :bool
    {
        return $this->coin->is500yen();
    }
}
