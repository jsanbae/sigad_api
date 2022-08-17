<?php

namespace Jsanbae\SigadAPI\Operations;

use Jsanbae\SigadAPI\Event;
use Jsanbae\SigadAPI\Operation;

class MovimientosCliente extends Operation
{

    public function Consultar(Event $evento, $_fecha_desde = null, $_fecha_hasta = null, $_rut_cliente = 0)
    {
        if (!$_fecha_desde) $_fecha_desde = date('Y-m-d');
        if (!$_fecha_hasta) $_fecha_hasta = date('Y-m-d');
            
        $params = [
            'rut' => $_rut_cliente, 
            'fechaDesde' => $_fecha_desde, 
            'fechaHasta' => $_fecha_hasta, 
            'tipoFecha' => $evento->getCodigo()
        ];

        $despachoDataObj = $this->getService()->Consultar($params)->MovimientosCliente;

        return (property_exists($despachoDataObj, 'Movimiento')) ? $despachoDataObj->Movimiento : [];
    }

}
