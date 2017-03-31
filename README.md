Higi90/SpaydParser
======
Short Payment Descriptor (SPAYD, SPD) format parser PHP libary

Installation
------------

[Composer](http://getcomposer.org/):

```sh
$ composer require higi90/spayd-parser
```


Usage
------------

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Higi90\SpaydParser;

$spaydString = 'SPD*1.0*ACC:CZ2806000000000168540115+FIOBCZPP*AM:450.00*CC:CZK*MSG:PLATBA ZA ZBOZI*X-VS:1234567890';
$spayd = new SpaydParser\Spayd($spaydString);

echo 'ACC: ' . $spayd->getParam('ACC') . "\n";
echo 'MSG: ' . $spayd->getParam('MSG') . "\n";

$account = $spayd->getAccount();
echo 'IBAN: ' . $account->getIban() . "\n";
echo 'SWIFT: ' . $account->getSwift() . "\n";

if($account instanceof SpaydParser\AccountCzech) {
    echo 'Account number: ' . $account->getAccountNumber() . "\n";
    echo 'Bank code: ' . $account->getBankCode() . "\n";
}
```