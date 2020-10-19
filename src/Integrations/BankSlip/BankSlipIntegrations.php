<?php

namespace FastPay\Integrations\BankSlip;

/**
 * Interface BankSlipIntegrations
 * @package FastPay\Integrations\Integrations
 */
interface BankSlipIntegrations
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