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
     * @param  string  $fid
     * @return mixed
     */
    public function captureTransaction(string $fid);

    /**
     * @param  string  $fid
     * @return mixed
     */
    public function findTransaction(string $fid);

    /**
     * @param  string  $fid
     * @return mixed
     */
    public function delTransaction(string $fid);

    /**
     * @param  string  $fid
     * @return mixed
     */
    public function reversalTransaction(string $fid);
}