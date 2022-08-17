<?php

namespace Jsanbae\SigadAPI;

class DespachoItem
{
    private $despacho;
    private $item;
    private $partida;
    private $descripcion;
    private $valor_cif;
    private $valor_fob;
    private $valor_flete;
    private $valor_seguro;
    private $kilos;
    private $cip;

    public function __construct(Despacho $_despacho, string $_item, string $_partida, string $_descripcion='', float $_valor_cif=0, float $_valor_fob=0, float $_valor_flete=0, float $_valor_seguro=0, float $_kilos=0, string $_cip='') {
        $this->despacho = $_despacho;
        $this->item = (int)$_item;
        $this->partida = $_partida;
        $this->descripcion = $_descripcion;
        $this->valor_cif = $_valor_cif;
        $this->valor_fob = $_valor_fob;
        $this->valor_flete = $_valor_flete;
        $this->valor_seguro = $_valor_seguro;
        $this->kilos = $_kilos;
        $this->cip = $_cip;
    }

    public function getDespacho()
    {
        return $this->despacho;
    }

    public function getItem():int
    {
        return $this->item;
    }

    public function getPartidaArancelaria():string
    {
        return $this->partida;
    }

    public function getDescripcion():string
    {
        return $this->descripcion;
    }

    public function getValorCIF():float
    {
        return $this->valor_cif;
    }

    public function getValorFOB():float
    {
        return $this->valor_fob;
    }

    public function getValorFlete():float
    {
        return $this->valor_flete;
    }

    public function getValorSeguro():float
    {
        return $this->valor_seguro;
    }

    public function getKilos():float
    {
        return $this->kilos;
    }

    public function getCIP():string
    {
        return $this->cip;
    }

    public function toArray():array
    {
        return [
            'despacho' => $this->despacho->getNumero(),
            'item' => $this->getItem(),
            'partida' => $this->getPartidaArancelaria(),
            'descripcion' => $this->getDescripcion(),
            'valor_cif' => $this->getValorCIF(),
            'valor_fob' => $this->getValorFOB(),
            'valor_flete' => $this->getValorFlete(),
            'valor_seguro' => $this->getValorSeguro(),
            'kilos' => $this->getKilos(),
            'cip' => $this->getCIP()
        ];
    }

}
