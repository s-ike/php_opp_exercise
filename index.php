<?php
use Drink\Money\Coin;
use Drink\Drink\DrinkType;
use Drink\VendingMachine;

require_once __DIR__.'/vendor/autoload.php';

$vending_machine = new VendingMachine();
$coin = new Coin(Coin::FIVE_HUNDRED, 1);
$type = new DrinkType(DrinkType::TEA);
$stock = $vending_machine->getStockQuantity($type);
$drink = $vending_machine->buy($coin, $type);

echo sprintf('飲み物: %s', $drink->getDrinkName()), PHP_EOL;
echo '<br>'.PHP_EOL;
$refund = $vending_machine->refund();
echo sprintf('お釣り: %s', $refund->toString()), PHP_EOL;

echo sprintf('購入前在庫: %s', $stock->toString()), PHP_EOL;

$stock = $vending_machine->getStockQuantity($type);
echo sprintf('購入後在庫: %s', $stock->toString()), PHP_EOL;
