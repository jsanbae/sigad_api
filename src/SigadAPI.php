<?php

namespace Jsanbae\SigadAPI;

use Jsanbae\SigadAPI\ClienteSIGAD;
use Jsanbae\SigadAPI\Operations\MovimientosCliente;
use Jsanbae\SigadAPI\Operations\DespachoAgencia;
use Jsanbae\SigadAPI\Operations\ProcesosVarios;
use Jsanbae\SigadAPI\Operations\DatosClientes;

use SoapClient;
use SoapFault;

class SigadAPI
{
    private $cliente_sigad;

    public function __construct(ClienteSIGAD $_cliente_sigad)
    {
        $this->cliente_sigad = $_cliente_sigad;
    }

    private function connect(string $_endpoint_uri)
    {
        $params = array_merge([
            'stream_context' => stream_context_create(['http' => ['user_agent' => 'PHPSoapClient']]),
            'cache_wsdl' => WSDL_CACHE_NONE,
            'trace' => true],
            $this->cliente_sigad->getCredentialEditradeAPI()
        );
        
        $endpoint_uri = $this->cliente_sigad->getBaseURLEditradeAPI() .  $_endpoint_uri;
        $service = new SoapClient($endpoint_uri, $params);

        return $service;
    }

    public function MovimientosCliente()
    {
        try {   
            $service = $this->connect('/ws/MovimientosCliente?wsdl');
            return new MovimientosCliente($service);

        } catch (SoapFault $fault) {
            trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
        }
    }

    public function DespachoAgencia()
    {
        try {
            $service = $this->connect('/ws/DespachoAgencia?wsdl');
            return new DespachoAgencia($service);
    
        } catch (SoapFault $fault) {
            trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
        }
    }

    public function getProcesosVarios()
    {
        try {
            $service = $this->connect('/ws/ProcesosVarios?wsdl');
            
            return new ProcesosVarios($service);

        } catch (SoapFault $fault) {
            trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
        }
    }

    public function getDatosClientes()
    {
        try {
            $service = $this->connect('/ws/GetDatosClientes?wsdl');
            
            return new DatosClientes($service);

        } catch (SoapFault $fault) {
            trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
        }
    }
}
