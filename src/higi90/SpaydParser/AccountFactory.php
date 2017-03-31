<?php

declare(strict_types = 1);

namespace Higi90\SpaydParser;

class AccountFactory
{
    /**
     * Parse IBAN
     *
     * @param string $ibanString
     * @return Account
     */
    public static function parseAccount(string $ibanString) : Account
    {
        if (AccountCzech::belongTo($ibanString)) {
            return new AccountCzech($ibanString);
        }
        
        return new AccountDefault($ibanString);
    }
}
