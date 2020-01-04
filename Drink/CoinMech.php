<?php
namespace Drink;

class CoinMech
{
    private $cash_box;
    private $payment = null;

    public function __construct()
    {
        $coin_of_100yen = new Coin(Coin::ONE_HUNDRED, 10);
        $this->cash_box = CashBox::getInstance(array($coin_of_100yen));
    }

    public function put(Coin $coin) :void
    {
        $this->payment = new Payment($coin);
    }

    public function doesNotHaveChange() :bool
    {
        return $this->payment->needChange() && $this->cash_box->isSmallNumberOf100yen(4);
    }

    public function commit() :void
    {
        $this->payment->commit($this->cash_box);
    }

    public function refund() :Money
    {
        return $this->payment->refund();
    }
}
