<?php

namespace FastPay\Util;

/**
 * Class CurlExec
 * @package FastPay\Util
 */
class CurlExec
{
    /**
     * @param $type
     * @param $endpoint
     * @param $credentials
     * @param $json
     * @return bool|string
     */
    public function curlExec($type, $endpoint, $credentials, $json)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->constructHeader($credentials));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        if ($type == "POST" || $type == "PUT") {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        }
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    /**
     * @param $data
     * @return string[]
     */
    private static function constructHeader($data)
    {
        return [
            'Content-Type: application/json',
            'Client-Code: ' . $data['CLIENT_CODE'],
            'Client-key: ' . $data['CLIENT_KEY']
        ];
    }
}