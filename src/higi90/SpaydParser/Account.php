<?php

declare(strict_types = 1);

namespace Higi90\SpaydParser;

abstract class Account
{

    protected $iban;
    protected $swift;

    public function __construct(string $ibanString)
    {
        $this->parseIban($ibanString);
    }

    /**
     * Parse IBAN
     *
     * @param string $ibanString
     */
    protected function parseIban(string $ibanString)
    {
        $ibanStringExploded = explode('+', $ibanString);
        $this->iban = $ibanStringExploded[0];
        
        if (!static::belongTo($this->iban)) {
            throw new Exception\InvalidStringFormatException('Invalid IBAN');
        }

        if (isset($ibanStringExploded[1])) {
            $this->swift = $ibanStringExploded[1];
        }
    }

    /**
     * Gets IBAN
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }
    
    /**
     * Gets Swift code - if set
     * @return string
     */
    public function getSwift()
    {
        return $this->swift;
    }

    /**
     * Logic for belongTo method
     */
    abstract public static function belongTo(string $ibanString) : bool;
}
