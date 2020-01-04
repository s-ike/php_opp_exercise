<?php
namespace Drink;

class VendingMachine
{
    private $quantityOfCoke = 5;        // コーラの在庫数
    private $quantityOfDietCoke = 5;    // ダイエットコーラの在庫数
    private $quantityOfTea = 5;         // お茶の在庫数
    private $numberOf100Yen = 10;       // 100円玉の在庫
    private $charge = 0;                // お釣り

    /**
     * ジュースを購入する.
     *
     * @param int $payment     投入金額. 100円と500円のみ受け付ける.
     * @param int $kindOfDrink ジュースの種類.
     *                    コーラ({@code Drink::$COKE}),ダイエットコーラ({@code Drink::$DIET_COKE},お茶({@code Drink::$TEA})が指定できる.
     * @return Drink 指定したジュース. 在庫不足や釣り銭不足で買えなかった場合は {@code null} が返される.
     */
    public function buy(int $payment, int $kindOfDrink) :Drink
    {
        // 100円と500円だけ受け付ける
        if (($payment != 100) && ($payment != 500)) {
            $this->charge++;
            return null;
        }

        if (($kindOfDrink == Drink::$COKE) && ($this->quantityOfCoke == 0)) {
            $this->charge += $payment;
            return null;
        } elseif (($kindOfDrink == Drink::$DIET_COKE) && ($this->quantityOfDietCoke == 0)) {
            $this->charge += $payment;
            return null;
        } elseif (($kindOfDrink == Drink::$TEA) && ($this->quantityOfTea == 0)) {
            $this->charge += $payment;
            return null;
        }

        // 釣り銭不足
        if ($payment == 500 && $this->numberOf100Yen < 4) {
            $this->charge += $payment;
            return null;
        }

        if ($payment == 100) {
            // 100円玉を釣り銭に使える
            $this->numberOf100Yen++;
        } elseif ($payment == 500) {
            // 400円のお釣り
            $this->charge += ($payment - 100);
            // 100円玉を釣り銭に使える
            $this->numberOf100Yen -= ($payment - 100) / 100;
        }

        if ($kindOfDrink == Drink::$COKE) {
            $this->quantityOfCoke--;
        } elseif ($kindOfDrink == Drink::$DIET_COKE) {
            $this->quantityOfDietCoke--;
        } else {
            $this->quantityOfTea--;
        }

        return new Drink($kindOfDrink);
    }

    /**
     * お釣りを取り出す.
     *
     * @return int お釣りの金額
     */
    public function refund() :int
    {
        $result = $this->charge;
        $this->charge = 0;
        return $result;
    }
}
