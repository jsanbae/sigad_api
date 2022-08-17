<?php

namespace Jsanbae\SigadAPI\Operations;

use Jsanbae\SigadAPI\Despacho;
use Jsanbae\SigadAPI\Operation;
use Jsanbae\SigadAPI\Utils\XML;

class DespachoAgencia extends Operation
{

    public function getPDFBase64(Despacho $_despacho, string $_tipo = '1') 
    {
        $params = [
            'despacho' => (int)$_despacho->getNumero(),
            'rutAgencia' => (string)$_despacho->getAgente()->getRutAgencia(),
            'tipo' => (string)$_tipo
        ];

        $response = XML::loadXmlStringAsArray($this->getService()->getDespacho($params)->return);
                
        return $response['Respuesta']['Data'][2]['Valor']; 
    }
}
