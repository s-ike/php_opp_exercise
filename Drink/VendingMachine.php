<?php
namespace Drink;

use Drink\Money\Coin;
use Drink\Drink\Drink;
use Drink\Money\Money;
use Drink\Stock\Storage;
use Drink\Money\CoinMech;
use Drink\Stock\Quantity;
use Drink\Drink\DrinkType;

class VendingMachine
{
    private $storage;
    private $coin_mech; // 金庫

    public function __construct()
    {
        $this->storage = new Storage();
        $this->coin_mech = new CoinMech();
    }

    /**
     * ジュースを購入する.
     *
     * @param int $payment      投入金額. 100円と500円のみ受け付ける.
     * @param int $drink_type   ジュースの種類.
     * コーラ({@code DrinkType::COKE}),ダイエットコーラ({@code DrinkType::DIET_COKE},お茶({@code DrinkType::TEA})が指定できる.
     * @return Drink 指定したジュース. 在庫不足や釣り銭不足で買えなかった場合は {@code null} が返される.
     */
    public function buy(Coin $payment, DrinkType $drink_type) :?Drink
    {
        $this->coin_mech->put($payment);

        if ($this->storage->doesNotHaveStock($drink_type)) {
            return null;
        }
        // 釣り銭不足
        if ($this->coin_mech->doesNotHaveChange()) {
            return null;
        }

        $this->coin_mech->commit();
        $this->storage->takeOut($drink_type);

        $drink = new Drink($drink_type);
        return $drink;
    }

    /**
     * お釣りを取り出す.
     *
     * @return Money お釣りのお金クラス
     */
    public function refund() :Money
    {
        return $this->coin_mech->refund();
    }

    /**
     * 在庫数を取り出す
     *
     * @return int
     */
    public function getStockQuantity(DrinkType $drink_type) :Quantity
    {
        return $this->storage->getStockQuantity($drink_type);
    }
}
