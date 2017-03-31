<?php

use Tester\Assert;
use Higi90\SpaydParser;

require __DIR__ . '/../bootstrap.php';

$account = new SpaydParser\AccountCzech('CZ7603000000000076327632+FIOBCZPP');

Assert::exception(function() {
    new SpaydParser\AccountCzech('CZ76030000000000076327632+FIOBCZPP');
}, 'Higi90\SpaydParser\Exception\InvalidStringFormatException');

Assert::exception(function() {
    new SpaydParser\AccountCzech('EN76030000000000076327632+FIOBCZPP');
}, 'Higi90\SpaydParser\Exception\InvalidStringFormatException');

Assert::same('0000000076327632', $account->getAccountNumber());
Assert::same('0300', $account->getBankCode());
Assert::same('CZ7603000000000076327632', $account->getIban());
Assert::same('FIOBCZPP', $account->getSwift());
