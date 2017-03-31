<?php

use Tester\Assert;
use Higi90\SpaydParser;

require __DIR__ . '/../bootstrap.php';

Assert::type('Higi90\SpaydParser\AccountCzech', SpaydParser\AccountFactory::parseAccount('CZ7603000000000076327632+FIOBCZPP'));
Assert::type('Higi90\SpaydParser\AccountDefault', SpaydParser\AccountFactory::parseAccount('EN7603000000000076327632+FIOBCZPP'));

Assert::type('Higi90\SpaydParser\AccountCzech', SpaydParser\AccountFactory::parseAccount('CZ7603000000000076327632'));
Assert::type('Higi90\SpaydParser\AccountDefault', SpaydParser\AccountFactory::parseAccount('EN7603000000000076327632'));
