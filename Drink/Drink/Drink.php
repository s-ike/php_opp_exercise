<?php
namespace Drink\Drink;

class Drink
{
    private $drink_type;

    public function __construct(DrinkType $drink_type)
    {
        $this->drink_type = $drink_type;
    }

    public function getDrinkName() :string
    {
        return $this->drink_type->getDrinkName();
    }
}
