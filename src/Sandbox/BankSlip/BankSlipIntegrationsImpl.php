<?php

namespace FastPay\Sandbox\BankSlip;

/**
 * Class BankSlipIntegrationsImpl
 * @package FastPay\Integrations\Integrations
 */
class BankSlipIntegrationsImpl implements BankSlipIntegrations
{
    /**
     * @var string
     */
    private $endpoint = "https://api-sandbox.fpay.me/boleto";

    /**
     * @param $data
     * @return string[]
     */
    private static function constructHeader($code, $key)
    {
        return [
            'Content-Type: application/json',
            'Client-Code: ' . $code,
            'Client-key: ' . $key
        ];
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function generateBankSlip($data)
    {
        $json = json_encode([
            'url_retorno'       => $data['info']['return'],
            'nu_referencia'     => $data['info']['reference'],
            'nm_cliente'        => $data['info']['client'],
            'nu_documento'      => $data['info']['document'],
            'ds_email'          => $data['info']['email'],
            'nu_telefone'       => $data['info']['telephone'],
            'vl_total'          => $data['info']['value'],
            'dt_vencimento'     => $data['info']['due_date'],
            'nu_parcelas'       => $data['info']['plots'],
            'tipo_venda'        => $data['info']['sale'],
            'dia_cobranca'      => $data['info']['charge_date'],
            'ds_cep'            => $data['info']['zip_code'],
            'ds_endereco'       => $data['info']['address'],
            'ds_bairro'         => $data['info']['neighborhood'],
            'ds_complemento'    => $data['info']['complement'],
            'ds_numero'         => $data['info']['number'],
            'nm_cidade'         => $data['info']['city'],
            'nm_estado'         => $data['info']['state'],
            'vl_juros'          => $data['info']['interest'],
            'vl_multa'          => $data['info']['daily_value'],
            'ds_info'           => $data['info']['aditional_info'],
            'ds_instrucao'      => $data['info']['isntructions']
        ]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->constructHeader($data['credentials']['CLIENT_CODE'], $data['credentials']['CLIENT_KEY']));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

        $response = json_decode(curl_exec($ch));
        curl_close($ch);

        return $response;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function alterDateBankSlip($data)
    {
        $json = json_encode([
            'dt_vencimento'     => $data['info']['due_date']
        ]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->endpoint . "/" . $data['info']['fid']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->constructHeader($data['credentials']['CLIENT_CODE'], $data['credentials']['CLIENT_KEY']));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

        $response = json_decode(curl_exec($ch));
        curl_close($ch);

        return $response;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function findBankSlip($data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->endpoint . "/" . $data['info']['fid']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->constructHeader($data['credentials']['CLIENT_CODE'], $data['credentials']['CLIENT_KEY']));

        $response = json_decode(curl_exec($ch));
        curl_close($ch);

        return $response;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function delBankSlip($data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->endpoint . "/" . $data['info']['fid']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->constructHeader($data['credentials']['CLIENT_CODE'], $data['credentials']['CLIENT_KEY']));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        $response = json_decode(curl_exec($ch));
        curl_close($ch);

        return $response;
    }
}