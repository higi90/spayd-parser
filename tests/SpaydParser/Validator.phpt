<?php

use Tester\Assert;
use Higi90\SpaydParser;


require __DIR__ . '/../bootstrap.php';

$validator = new SpaydParser\Validator();

Assert::same(true, $validator->validate('SPD*1.0*ACC:CZ7603000000000076327632*AM:200.00*CC:CZK*X-VS:1234567890*MSG:CLOVEK V TISNI'));

Assert::exception(function() use ($validator) {       
    $validator->validate('asdasdasd');
}, 'Higi90\SpaydParser\Exception\InvalidStringFormatException');

// Wrong prefix
Assert::exception(function() use ($validator) {       
    $validator->validate('SPDD*1.0*ACC:CZ7603000000000076327632*AM:200.00*CC:CZK*X-VS:1234567890*MSG:CLOVEK V TISNI');
}, 'Higi90\SpaydParser\Exception\InvalidStringFormatException');

// Wrong param
Assert::exception(function() use ($validator) {       
    $validator->validate('SPDD*1.0*ACC:CZ7603000000000076327632*AM:200.00*CC:CZKKU*X-VS:1234567890*MSG:CLOVEK V TISNI');
}, 'Higi90\SpaydParser\Exception\InvalidStringFormatException');
