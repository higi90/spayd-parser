Higi90/SpaydParser
======
Spayd format parser PHP libary

Installation
------------

[Composer](http://getcomposer.org/):

```sh
$ composer require higi90/spayd-parser
```


Usage
------------
``php
$spayd = new SpaydParser\Spayd('SPD*1.0*ACC:CZ2806000000000168540115*AM:450.00*CC:CZK*MSG:PLATBA ZA ZBOZI*X-VS:1234567890');
$account = $spayd->getParam('ACC');
```