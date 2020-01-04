<?php
namespace Drink;

class Drink
{
    private $kind;

    public function __construct(DrinkType $drink_type)
    {
        $this->kind = $drink_type->getType();
    }

    public function getKind() :int
    {
        return $this->kind;
    }
}
