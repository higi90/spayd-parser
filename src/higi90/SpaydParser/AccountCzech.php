<?php

declare(strict_types = 1);

namespace Higi90\SpaydParser;

class AccountCzech extends Account
{
    /**
     * Account number
     * @var string
     */
    private $accountNumber;
    
    /**
     * Bank code
     * @var string
     */
    private $bankCode;
    
    public function __construct(string $ibanString)
    {
        parent::__construct($ibanString);
        $this->parseCzech();
    }

    /**
     * Parse account number and bank code
     *
     * @throws Exception\InvalidStringFormatException
     * @return void
     */
    protected function parseCzech()
    {
        if (strlen($this->iban) != 24) {
            throw new Exception\InvalidStringFormatException('IBAN for Czech republic string is required to be 24 characters long');
        }

        $this->bankCode = substr($this->iban, 4, 4);
        $this->accountNumber = substr($this->iban, 8, 6) . '-' . substr($this->iban, 14, 10);
    }

    /**
     * Gets account number (for CZ bank)
     * @return string
     */
    public function getAccountNumber() : string
    {
        return $this->accountNumber;
    }
    
    /**
     * Gets bank code (for CZ bank)
     * @return string
     */
    public function getBankCode() : string
    {
        return $this->bankCode;
    }
    
    public static function belongTo(string $ibanString) : bool
    {
        return (substr($ibanString, 0, 2) === 'CZ');
    }
}
