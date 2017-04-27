<?php

declare(strict_types = 1);

namespace Higi90\SpaydParser;

class Spayd
{
    /**
     * Possible key values
     */
    const EXPECTED_PARAMS = [
        'ACC',
        'ALT-ACC',
        'AM',
        'CC',
        'RF',
        'RN',
        'DT',
        'PT',
        'MSG',
        'CRC32',
        'NT',
        'NTA',
        'X-PER',
        'X-VS',
        'X-SS',
        'X-KS',
        'X-ID',
        'X-URL',
    ];
    
    /**
     * Parsed params from string
     * @var array
     */
    private $params = [];
    
    private $account;
    
    /**
     * @param string $spaydString
     */
    public function __construct(string $spaydString)
    {
        $validator = new Validator();
        $validator->validate($spaydString);
        
        $this->splitString($spaydString);
    }

    /**
     * Divides spayd string into $params array
     *
     * @param string $spaydString
     * @return void
     */
    private function splitString(string $spaydString)
    {
        $spaydStringDecoded = rawurldecode($spaydString);
        
        if (substr($spaydStringDecoded, -1) == '*') {
            $spaydArray = explode('*', substr($spaydStringDecoded, 0, -1));
        } else {
             $spaydArray = explode('*', $spaydStringDecoded);
        }
        
        $this->params['VERSION'] = $spaydArray[1];
        
        unset($spaydArray[0]);
        unset($spaydArray[1]);
        
        foreach ($spaydArray as $item) {
            $itemExploded = explode(':', $item);
            
            if (!isset($itemExploded[1]) || !in_array($itemExploded[0], self::EXPECTED_PARAMS)) {
                continue;
            }
            
            $this->params[$itemExploded[0]] = $itemExploded[1];
        }
        
        $this->account = AccountFactory::parseAccount($this->getParam('ACC'));
    }
    
    /**
     * Gets string parameter
     *
     * @param string $key
     * @throws Exception\InvalidParamKeyException
     * @return string
     */
    public function getParam(string $key)
    {
        if (!in_array($key, self::EXPECTED_PARAMS)) {
            throw new Exception\InvalidParamKeyException('Parameter ' . $key . ' is not valid.');
        }
        
        if (isset($this->params[$key])) {
            return $this->params[$key];
        } else {
            return false;
        }
    }
    
    /**
     * Gets all sprayd params
     *
     * @return array
     */
    public function getParams() : array
    {
        return $this->params;
    }
    
    /**
     * Gets account
     *
     * @return Higi90\SpaydParser\Account
     */
    public function getAccount() : Account
    {
        return $this->account;
    }
    
    /**
     * Gets due date datetime obj
     * 
     * @return bool|Datetime
     */
    public function getDueDate()
    {
        if(empty($this->getParam('DT'))) {
            return false;
        }
        
        return \DateTime::createFromFormat('Ymd', $this->getParam('DT'));
    }
}
