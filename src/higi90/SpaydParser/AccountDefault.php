<?php

declare(strict_types = 1);

namespace Higi90\SpaydParser;

class AccountDefault extends Account
{
    public static function belongTo(string $ibanString) : bool
    {
        return true;
    }
}
