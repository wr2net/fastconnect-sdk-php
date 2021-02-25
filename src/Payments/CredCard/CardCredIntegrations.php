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
     * @var CurlExec
     */
    private $connection;

    /**
     * BankSlipIntegrationsImpl constructor.
     * @param string $endpoint
     * @param array $credentials
     */
    public function __construct(string $endpoint, array $credentials)
    {
        $this->endpoint = $endpoint . '/credito';
        $this->credentials = $credentials;
        $this->connection = new CurlExec;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function fullTransaction($data)
    {
        $parse = [
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
        ];
        $json = json_encode($parse);
        return $this->connection->curlExec("POST", $this->endpoint, $this->credentials, $json);
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

        return $this->connection->curlExec("POST", $this->endpoint, $this->credentials, $json);
    }

    /**
     * @param  string  $fid
     * @return bool|mixed|string
     */
    public function captureTransaction(string $fid)
    {
        $this->endpoint .= '/' . $fid . '/capturar';
        return $this->connection->curlExec("PUT", $this->endpoint, $this->credentials);
    }

    /**
     * @param  string  $fid
     * @return bool|mixed|string
     */
    public function findTransaction(string $fid)
    {
        $this->endpoint .= '/' . $fid;
        return $this->connection->curlExec("GET", $this->endpoint, $this->credentials);
    }

    /**
     * @param  string  $fid
     * @return bool|mixed|string
     */
    public function delTransaction(string $fid)
    {
        $this->endpoint .= '/' . $fid;
        return $this->connection->curlExec("DELETE", $this->endpoint, $this->credentials);
    }

    /**
     * @param  string  $fid
     * @return bool|mixed|string
     */
    public function reversalTransaction(string $fid)
    {
        $this->endpoint .= '/' . $fid . '/estornar';
        return $this->connection->curlExec("DELETE", $this->endpoint, $this->credentials);
    }
}