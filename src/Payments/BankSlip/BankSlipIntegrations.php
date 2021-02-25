<?php

namespace FastPay\Payments\BankSlip;

use FastPay\Payments\Integration\CurlExec;

/**
 * Class BankSlipIntegrationsImpl
 * @package FastPay\Sandbox\BankSlip
 */
class BankSlipIntegrations implements BankSlipIntegrationsInterface
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
     * BankSlipIntegrations constructor.
     * @param string $endpoint
     * @param array $credentials
     */
    public function __construct(string $endpoint, array $credentials)
    {
        $this->endpoint = $endpoint . '/boleto';
        $this->credentials = $credentials;
        $this->connection = new CurlExec;
    }

    /**
     * @param $data
     * @return bool|mixed|string
     */
    public function generateBankSlip($data)
    {
        $parse = [
            'url_retorno' => $data['return'],
            'nu_referencia' => $data['reference'],
            'nm_cliente' => $data['client'],
            'nu_documento' => $data['document'],
            'ds_email' => $data['email'],
            'nu_telefone' => $data['telephone'],
            'vl_total' => $data['value'],
            'dt_vencimento' => $data['due_date'],
            'nu_parcelas' => $data['plots'],
            'tipo_venda' => $data['sale'],
            'dia_cobranca' => $data['charge_date'],
            'ds_cep' => $data['zip_code'],
            'ds_endereco' => $data['address'],
            'ds_bairro' => $data['neighborhood'],
            'ds_complemento' => $data['complement'],
            'ds_numero' => $data['number'],
            'nm_cidade' => $data['city'],
            'nm_estado' => $data['state'],
            'vl_juros' => $data['interest'],
            'vl_multa' => $data['daily_value'],
            'ds_info' => $data['aditional_info'],
            'ds_instrucao' => $data['instructions']
        ];
        $json = json_encode($parse);
        return $this->connection->curlExec("POST", $this->endpoint, $this->credentials, $json);
    }

    /**
     * @param  string  $fid
     * @param  array  $data
     * @return bool|mixed|string
     */
    public function alterDateBankSlip(string $fid, array $data)
    {
        $this->endpoint .= '/' . $fid;
        $json = json_encode([
            'dt_vencimento'     => $data['due_date']
        ]);

        return $this->connection->curlExec("PUT", $this->endpoint, $this->credentials, $json);
    }

    /**
     * @param  string  $fid
     * @return bool|mixed|string
     */
    public function findBankSlip(string $fid)
    {
        $this->endpoint .= '/' . $fid;
        return $this->connection->curlExec("GET", $this->endpoint, $this->credentials);
    }

    /**
     * @param  string  $fid
     * @return bool|mixed|string
     */
    public function delBankSlip(string $fid)
    {
        $this->endpoint .= '/' . $fid;
        return $this->connection->curlExec("DELETE", $this->endpoint, $this->credentials);
    }
}