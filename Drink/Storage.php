<?php
namespace Drink;

class Storage
{
    private $stocks;

    public function __construct()
    {
        $this->stocks[DrinkType::COKE]      = new StockOfDrink(5);
        $this->stocks[DrinkType::DIET_COKE] = new StockOfDrink(5);
        $this->stocks[DrinkType::TEA]       = new StockOfDrink(5);
    }

    public function doesNotHaveStock(DrinkType $drink_type) :bool
    {
        if ($type = $this->findStock($drink_type)) {
            return false;
        }
        return true;
    }

    public function findStock(DrinkType $drink_type) :?StockOfDrink
    {
        $type = $this->stocks[$drink_type->getType()];
        return $type ?: null;
    }

    public function takeOut(DrinkType $drink_type)
    {
        if (! $stock = $this->findStock($drink_type)) {
            return null;
        }
        if ($stock->isEmpty()) {
            return null;
        }
        $stock->decrement();
        return new Drink($drink_type);
    }

    public function getStockQuantity(DrinkType $drink_type)
    {
        $stock = $stock = $this->findStock($drink_type);
        return $stock->getQuantity();
    }
}
