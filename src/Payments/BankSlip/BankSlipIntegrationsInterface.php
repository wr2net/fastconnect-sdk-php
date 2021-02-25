<?php

namespace FastPay\Payments\BankSlip;

/**
 * Interface BankSlipIntegrations
 * @package FastPay\Integrations\Integrations
 */
interface BankSlipIntegrationsInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function generateBankSlip(array $data);

    /**
     * @param  string  $fid
     * @param  array  $data
     * @return mixed
     */
    public function alterDateBankSlip(string $fid, array $data);

    /**
     * @param  string  $fid
     * @return mixed
     */
    public function findBankSlip(string $fid);

    /**
     * @param  string  $fid
     * @return mixed
     */
    public function delBankSlip(string $fid);
}