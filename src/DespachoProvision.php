<?php

namespace Jsanbae\SigadAPI;

use Jsanbae\SigadAPI\Aduana;

class DespachoProvision
{
    private $despacho;    

    public function __construct(
        Despacho $_despacho, 
        string $_fecha_prov = null,
        string $_eta = null,
        float $_tcambio = 0.0,
        int $_total_gcp = 0,
        float $_total_gcpu = 0.0,
        int $_total_provision = 0,
        int $_total_desembolsos = 0,
        float $_valor_cif = 0.0,
        Aduana $_aduana = null,
        string $_nave = null,
    ){
        $this->despacho = $_despacho;
        $this->fecha_prov = $_fecha_prov;
        $this->eta = $_eta;
        $this->tcambio = $_tcambio;
        $this->total_gcp = $_total_gcp;
        $this->total_gcpu = $_total_gcpu;
        $this->total_provision = $_total_provision;
        $this->total_desembolsos = $_total_desembolsos;
        $this->valor_cif = $_valor_cif;
        $this->aduana = $_aduana;
        $this->nave = $_nave;
    }

    public function getDespacho():Despacho
    {
        return $this->despacho;
    }

    public function toArray()
    {
        return [
            'despacho' => $this->despacho->getNumero(),
            'fecha_prov' => $this->fecha_prov,
            'eta' => $this->eta,
            'tcambio' => $this->tcambio,
            'total_gcp' => $this->total_gcp,
            'total_gcpu' => $this->total_gcpu,
            'total_provision' => $this->total_provision,
            'total_desembolsos' => $this->total_desembolsos,
            'valor_cif' => $this->valor_cif,
            'aduana' => $this->aduana->getNombre(),
            'nave' => $this->nave,
        ];
    }
}
