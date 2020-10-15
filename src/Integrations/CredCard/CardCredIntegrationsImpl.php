<?php

namespace FastPay\Integrations\CredCard;

class CardCredIntegrationsImpl implements CardCredIntegrations
{
    /**
     * @var array
     */
    private $credentials;

    /**
     * @var string
     */
    private $endpoint;

    /**
     * BankSlipIntegrationsImpl constructor.
     * @param string $endpoint
     * @param array $credentials
     */
    public function __construct(string $endpoint, array $credentials)
    {
        $this->endpoint = $endpoint;
        $this->credentials = $credentials;
    }

    public function fullTransaction($data)
    {

    }
}