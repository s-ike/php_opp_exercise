<?php
use Drink\VendingMachine;

require_once __DIR__.'/vendor/autoload.php';

$vending_machine = new VendingMachine();
$drink = $vending_machine->buy(500, 1);

print_r($drink);

$refund = $vending_machine->refund();
echo sprintf('お釣り: %d円', $refund);
