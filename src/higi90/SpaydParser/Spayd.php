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
     * Divides sprayd string into $params array
     *
     * @param string $spaydString
     * @return void
     */
    private function splitString(string $spaydString)
    {
        $spaydArray = explode('*', $spaydString);
        
        $this->params['VERSION'] = $spaydArray[1];
        
        unset($spaydArray[0]);
        unset($spaydArray[1]);
        
        foreach ($spaydArray as $item) {
            $itemExploded = explode(':', $item);
            $this->params[$itemExploded[0]] = $itemExploded[1];
        }
    }
    
    /**
     * Gets string parameter
     *
     * @param string $key
     * @throws Exception\InvalidParamKeyException
     * @return string
     */
    public function getParam(string $key) : string
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
     * Get all sprayd params
     *
     * @return array
     */
    public function getParams() : array
    {
        return $this->params;
    }
}
