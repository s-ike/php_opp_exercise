<?php
namespace Drink;

class VendingMachine
{
    private $stock_of_coke;        // コーラの在庫数
    private $stock_of_dietcoke;    // ダイエットコーラの在庫数
    private $stock_of_tea;         // お茶の在庫数
    private $stock_of_100yen;       // 100円玉の在庫
    private $change;               // お釣り

    public function __construct()
    {
        $this->stock_of_coke        = new StockOfDrink(5);
        $this->stock_of_dietcoke    = new StockOfDrink(5);
        $this->stock_of_tea         = new StockOfDrink(5);

        $coin_of_100yen = new Coin(Coin::ONE_HUNDRED, 10);
        $this->stock_of_100yen  = StockOfCoin::getInstance(array($coin_of_100yen));
        $this->change           = new Change();
    }

    /**
     * ジュースを購入する.
     *
     * @param int $payment          投入金額. 100円と500円のみ受け付ける.
     * @param int $kind_of_drink    ジュースの種類.
     * コーラ({@code DrinkType::COKE}),ダイエットコーラ({@code DrinkType::DIET_COKE},お茶({@code DrinkType::TEA})が指定できる.
     * @return Drink 指定したジュース. 在庫不足や釣り銭不足で買えなかった場合は {@code null} が返される.
     */
    public function buy(Coin $payment, DrinkType $kind_of_drink) :?Drink
    {
        // 100円と500円だけ受け付ける
        if (($payment->getType() !== Coin::ONE_HUNDRED)
        && ($payment->getType() !== Coin::FIVE_HUNDRED)) {
            $this->change->add($payment);
            return null;
        }

        if (($kind_of_drink->getType() === DrinkType::COKE)
        && ($this->stock_of_coke->getQuantity() === 0)) {
            $this->change->add($payment);
            return null;
        } elseif (($kind_of_drink->getType() === DrinkType::DIET_COKE)
        && ($this->stock_of_dietcoke->getQuantity() === 0)) {
            $this->change->add($payment);
            return null;
        } elseif (($kind_of_drink->getType() === DrinkType::TEA)
        && ($this->stock_of_tea->getQuantity() === 0)) {
            $this->change->add($payment);
            return null;
        }

        // 釣り銭不足
        if ($payment->getType() === Coin::FIVE_HUNDRED
        && $this->stock_of_100yen->getNumberOf100yen() < 4) {
            $this->change->add($payment);
            return null;
        }

        if ($payment->getType() === Coin::ONE_HUNDRED) {
            // 100円玉を釣り銭に使える
            $this->stock_of_100yen->add($payment);
        } elseif ($payment->getType() === Coin::FIVE_HUNDRED) {
            // 400円のお釣り
            $count = (Coin::FIVE_HUNDRED - Coin::ONE_HUNDRED) / Coin::ONE_HUNDRED;
            $change = new Coin(Coin::ONE_HUNDRED, $count);
            $this->change->add($change);
            // 100円玉を釣り銭に使える
            for ($i = 0; $i < $count; $i++) {
                $this->stock_of_100yen->reduceOne100yen();
            }
        }

        if ($kind_of_drink->getType() === DrinkType::COKE) {
            $this->stock_of_coke->decrement();
        } elseif ($kind_of_drink->getType() === DrinkType::DIET_COKE) {
            $this->stock_of_dietcoke->decrement();
        } else {
            $this->stock_of_tea->decrement();
        }

        $drink = new Drink($kind_of_drink);
        return $drink;
    }

    /**
     * お釣りを取り出す.
     *
     * @return int お釣りの金額
     */
    public function refund() :int
    {
        $result = $this->change->getAmount();
        $this->change->clear();
        return $result;
    }
}
