<?php

namespace FastPay\Payments\CredCard;

/**
 * Interface CardCredIntegrations
 * @package FastPay\Integrations\CredCard
 */
interface CardCredIntegrationsInterface
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

    /**
     * @return mixed
     */
    public function captureTransaction();

    /**
     * @return mixed
     */
    public function findTransaction();

    /**
     * @return mixed
     */
    public function delTransaction();

    /**
     * @return mixed
     */
    public function reversalTransaction();
}