<?php

use Tester\Assert;
use Higi90\SpaydParser;

require __DIR__ . '/../bootstrap.php';

$account = new SpaydParser\AccountDefault('EN7603000000000076327632+FIOBCZPP');

Assert::same('EN7603000000000076327632', $account->getIban());
Assert::same('FIOBCZPP', $account->getSwift());
