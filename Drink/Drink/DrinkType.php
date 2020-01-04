<?php
namespace Drink\Drink;

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

    public function typeEquals(int $type)
    {
        return $this->type === $type;
    }

    public function getDrinkName() :string
    {
        $result = '';
        switch ($this->type) {
            case self::COKE:
                $result = 'コーラ';
                break;

            case self::DIET_COKE:
                $result = 'ダイエットコーラ';
                break;

            case self::TEA:
                $result = 'お茶';
                break;
        }
        return $result;
    }

    public function getType()
    {
        return $this->type;
    }
}
