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
    public function generateBankSlip($data);

    /**
     * @param $data
     * @return mixed
     */
    public function alterDateBankSlip($data);

    /**
     * @param $data
     * @return mixed
     */
    public function findBankSlip();

    /**
     * @param $data
     * @return mixed
     */
    public function delBankSlip();
}