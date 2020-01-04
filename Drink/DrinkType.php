<?php
namespace Drink;

class DrinkType
{
    const COKE = 0;
    const DIET_COKE = 1;
    const TEA = 2;

    private $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function getType() :int
    {
        return $this->type;
    }
}
