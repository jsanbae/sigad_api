<?php

namespace Jsanbae\SigadAPI;

use Jsanbae\SigadAPI\Despacho;

class DespachoCuenta
{
    private $despacho;
    private $codigo;
    private $monto_usd;

    public function __construct(Despacho $_despacho, int $_codigo, float $_monto_usd = 0.0)
    {
        $this->codigo = $_codigo;
        $this->monto_usd = $_monto_usd;
        $this->despacho = $_despacho;
    }

    public function getDespacho():Despacho
    {
        return $this->despacho;
    }
    
    public function getCodigo():int
    {
        return $this->codigo;
    }

    public function getMontoUSD():float
    {
        return $this->monto_usd;
    }

    public function toArray():array
    {
        return [
            'despacho' => $this->despacho->getNumero(),
            'codigo' => $this->codigo,
            'monto_usd' => $this->monto_usd
        ];
    }
}
