<?php
namespace Drink;

class Drink
{
    public static $COKE = 0;
    public static $DIET_COKE = 1;
    public static $TEA = 2;

    private $kind;

    public function drink(int $kind)
    {
        $this->kind = $kind;
    }

    public function getKind()
    {
        return $this->kind;
    }
}
