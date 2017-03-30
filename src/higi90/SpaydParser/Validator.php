<?php

declare(strict_types = 1);

namespace Higi90\SpaydParser;

use GuzzleHttp;

class Validator
{

    const API_URL = 'http://api.paylibo.com/paylibo/validator/string/';

    /**
     * Validate string in spayd format
     *
     * @param string $spaydString
     * @return bool
     * @throws Exception\InvalidStringFormatException
     * @throws GuzzleHttp\Exception\ClientException
     */
    public function validate(string $spaydString): bool
    {
        $client = new GuzzleHttp\Client();

        $params = [
            'paymentString' => $spaydString
        ];

        try {
            $client->request('GET', self::API_URL . '?' . http_build_query($params)); 
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $this->handleGuzzleException($e);
        }

        return true;
    }

    /**
     * Handles GuzzleHttp\Exception\ClientException
     * @param GuzzleHttp\Exception\ClientException $e
     * @throws Exception\InvalidStringFormatException
     * @throws GuzzleHttp\Exception\ClientException
     */
    private function handleGuzzleException(GuzzleHttp\Exception\ClientException $e)
    {
        $responseContent = $e->getResponse()->getBody()->getContents();
        $responseArray = json_decode($responseContent, true);

        if ($responseArray) {
            $errorMsg = "";

            foreach ($responseArray['errors'] as $error) {
                $errorMsg .= $error['description'] . ' ';
            }

            throw new Exception\InvalidStringFormatException($errorMsg);
        } else {
            throw $e;
        }
    }
}
