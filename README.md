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
$spaydString = 'SPD*1.0*ACC:CZ2806000000000168540115*AM:450.00*CC:CZK*MSG:PLATBA ZA ZBOZI*X-VS:1234567890';
$spayd = new \Higi90\SpaydParser\Spayd($spaydString);
$account = $spayd->getParam('ACC');
```