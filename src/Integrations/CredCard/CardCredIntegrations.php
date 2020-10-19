<?php

namespace FastPay\Integrations\CredCard;

/**
 * Interface CardCredIntegrations
 * @package FastPay\Integrations\CredCard
 */
interface CardCredIntegrations
{
    /**
     * @param $data
     * @return mixed
     */
    public function fullTransaction($data);

    /**
     * @param $data
     * @return mixed
     */
    public function tokenTransaction($data);
}