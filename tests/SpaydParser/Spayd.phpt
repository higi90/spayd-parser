<?php

use Tester\Assert;
use Higi90\SpaydParser;


require __DIR__ . '/../bootstrap.php';

$spayd = new SpaydParser\Spayd('SPD*1.0*ACC:CZ7603000000000076327632*AM:200.00*CC:CZK*X-VS:1234567890*MSG:CLOVEK V TISNI');

Assert::same('CZ7603000000000076327632', $spayd->getParam('ACC'));
Assert::same('200.00', $spayd->getParam('AM'));

Assert::exception(function() use($spayd) {       
    $spayd->getParam('INVALID');
}, 'Higi90\SpaydParser\Exception\InvalidParamKeyException');



$spaydEnd = new SpaydParser\Spayd('SPD*1.0*ACC:CZ7603000000000076327632*AM:200.00*CC:CZK*X-VS:1234567890*MSG:CLOVEK V TISNI*');

Assert::same('CZ7603000000000076327632', $spaydEnd->getParam('ACC'));
Assert::same('200.00', $spaydEnd->getParam('AM'));

Assert::exception(function() use($spaydEnd) {       
    $spaydEnd->getParam('INVALID');
}, 'Higi90\SpaydParser\Exception\InvalidParamKeyException');