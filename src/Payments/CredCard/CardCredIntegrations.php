<?php

namespace FastPay\Payments\CredCard;

use FastPay\Payments\Integration\CurlExec;

/**
 * Class CardCredIntegrationsImpl
 * @package FastPay\Integrations\CredCard
 */
class CardCredIntegrations implements CardCredIntegrationsInterface
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

    /**
     * @param $data
     * @return mixed
     */
    public function fullTransaction($data)
    {
        $json = json_encode([
            'url_retorno'       => $data['return'],
            'nu_referencia'     => $data['reference'],
            'nm_cliente'        => $data['client'],
            'nu_documento'      => $data['document'],
            'ds_email'          => $data['email'],
            'nu_telefone'       => $data['telephone'],
            'ds_cep'            => $data['zip_code'],
            'ds_endereco'       => $data['address'],
            'ds_bairro'         => $data['neighborhood'],
            'ds_complemento'    => $data['complement'],
            'ds_numero'         => $data['number'],
            'nm_cidade'         => $data['city'],
            'nm_estado'         => $data['state'],
            'vl_total'          => $data['value'],
            'nu_parcelas'       => $data['plots'],
            'tipo_venda'        => $data['sale'],
            'ds_softdescriptor' => $data['soft_descriptor'],
            'ds_cartao_token'   => $data['token_card'],
            'nm_bandeira'       => $data['flag'],
            'nu_cartao'         => $data['card_number'],
            'nm_titular'        => $data['client_name'],
            'dt_validade'       => $data['validate'],
            'tp_capturar'       => $data['capture']
        ]);

        return CurlExec::curlExec("POST", $this->endpoint, $this->credentials, $json);
    }

    /**
     * @param $data
     * @return bool|string
     */
    public function tokenTransaction($data)
    {
        $json = json_encode([
            'url_retorno'       => $data['return'],
            'nu_referencia'     => $data['reference'],
            'nm_cliente'        => $data['client'],
            'nu_documento'      => $data['document'],
            'ds_email'          => $data['email'],
            'nu_telefone'       => $data['telephone'],
            'vl_total'          => $data['value'],
            'dt_vencimento'     => $data['due_date'],
            'dt_cobranca'       => $data['charge_date'],
            'nu_parcelas'       => $data['plots'],
            'tipo_venda'        => $data['sale'],
            'ds_softdescriptor' => $data['soft_descriptor'],
            'ds_cartao_token'   => $data['token_card']
        ]);

        return CurlExec::curlExec("POST", $this->endpoint, $this->credentials, $json);
    }

    /**
     * @return bool|mixed|string
     */
    public function captureTransaction()
    {
        return CurlExec::curlExec("PUT", $this->endpoint, $this->credentials);
    }

    /**
     * @return bool|mixed|string
     */
    public function findTransaction()
    {
        return CurlExec::curlExec("GET", $this->endpoint, $this->credentials);
    }

    /**
     * @return bool|mixed|string
     */
    public function delTransaction()
    {
        return CurlExec::curlExec("DELETE", $this->endpoint, $this->credentials);
    }

    /**
     * @return bool|mixed|string
     */
    public function reversalTransaction()
    {
        return CurlExec::curlExec("DELETE", $this->endpoint, $this->credentials);
    }
}