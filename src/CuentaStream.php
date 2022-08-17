<?php

namespace Jsanbae\SigadAPI;

use Jsanbae\SigadAPI\DespachoCuenta;

class CuentaStream
{
    private $cuentas = [];

    public function add(DespachoCuenta $_cuenta):void
    {
        $this->cuentas[] = $_cuenta;
    }

    public function list():array
    {
        return $this->cuentas;
    }

    public function filteredByCodigos(array $_codigos):array
    {
        return array_filter($this->cuentas, function ($cuenta) use ($_codigos) {
            return in_array($cuenta->getCodigo(), $_codigos);
        });
    }

    public function hasCuentaCodigo(int $_codigo):bool
    {
        return count($this->filteredByCodigos([$_codigo])) > 0;
    }

    public function hasCuentas():bool
    {
        return count($this->cuentas) > 0;
    }

    public function isEmpty():bool
    {
        return count($this->cuentas) === 0;
    }
}
