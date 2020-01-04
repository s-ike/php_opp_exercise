<?php
namespace Drink;

class CoinMech
{
    private $cash_box;
    private $payment = null;
    private $change;

    public function __construct()
    {
        $coin_of_100yen = new Coin(Coin::ONE_HUNDRED, 10);
        $this->cash_box = CashBox::getInstance(array($coin_of_100yen));
        $this->change   = new Change();
    }

    public function put(Coin $coin)
    {
        $this->payment = new Payment($coin);
    }

    public function doesNotHaveChange()
    {
        return $this->payment->needChange() && $this->cash_box->isSmallNumberOf100yen(4);
    }

    public function addChange(Coin $payment) :void
    {
        $this->change->add($payment);
    }

    public function commit() :void
    {
        if ($this->payment->is100yen()) {
            // 100円玉を釣り銭に使える
            $this->cash_box->add($this->payment->get100yen());
        } elseif ($this->payment->is500yen()) {
            // 400円のお釣り
            $this->addChange($this->cash_box->takeOutChange());
        }
    }

    public function refund() :Money
    {
        $money = $this->change->toMoney();
        $this->change->clear();
        return $money;
    }
}
