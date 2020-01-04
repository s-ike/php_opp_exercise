<?php
use Drink\Coin;
use Drink\DrinkType;
use Drink\VendingMachine;

require_once __DIR__.'/vendor/autoload.php';

$vending_machine = new VendingMachine();
$coin = new Coin(Coin::FIVE_HUNDRED, 1);
$type = new DrinkType(DrinkType::TEA);
$drink = $vending_machine->buy($coin, $type);

echo sprintf('飲み物番号: %d', $drink->getKind()), PHP_EOL;

$refund = $vending_machine->refund();
echo sprintf('お釣り: %d円', $refund), PHP_EOL;
