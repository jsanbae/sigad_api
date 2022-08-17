<?php

namespace Jsanbae\SigadAPI;

use Jsanbae\SigadAPI\Aduana;
use Jsanbae\SigadAPI\Agente;
use Jsanbae\SigadAPI\EventStream;
use Jsanbae\SigadAPI\CuentaStream;
use Jsanbae\SigadAPI\DespachoCuenta;
use Jsanbae\SigadAPI\DespachoProvision;
use Jsanbae\SigadAPI\Events\EventoDinamico;
use Jsanbae\SigadAPI\Utils\Data;

class Despacho
{
    private $agente;
    private $data = [];

    public function __construct(int $_nro_despacho, Agente $_agente)
    {
        $this->data['DESPACHO'] = $_nro_despacho;
        $this->agente = $_agente;
    }

    public function populateFromObject(object $_data):void
    {
        $this->populateFromArray((array)$_data);
    }

    public function populateFromArray(array $_data):void
    {
        $this->data = Data::trim($_data);
    }

    public function toArray():array
    {
        return $this->data;
    }

    public function getNumero():int
    {
        return $this->data['DESPACHO'];
    }

    public function getAgente():Agente
    {
        return $this->agente;
    }

    public function getAduana():Aduana
    {
        if (!array_key_exists('COD_ADNA_ACEPT', $this->data)) return new Aduana(0);

        return new Aduana((int) $this->data['COD_ADNA_ACEPT']);
    }

    public function operacionType():string
    {
        if (!array_key_exists('CODIGO_OPER', $this->data)) throw new \Exception('No se puede determinar el tipo de operación');

        $codigo_operacion = (int) $this->data['CODIGO_OPER'];

        if ($codigo_operacion < 199) return 'Importación';
        if ($codigo_operacion >= 200) return 'Exportación';

        return 'Desconocido (' . $codigo_operacion . ')';
    }

    public function getEventos():EventStream
    {
        $eventStream = new EventStream();

        if (!array_key_exists('EVENTOS', $this->data)) return $eventStream;
        
        $events = $this->data['EVENTOS'];

        if (is_object($events)) $eventStream->add(new DespachoEvent($this, new EventoDinamico(trim($events->STATUS)), $events->FECHA_EVENTO));

        if (is_array($events)) {
            foreach($events as $event) {
                $eventStream->add(new DespachoEvent($this, new EventoDinamico(trim($event->STATUS)), $event->FECHA_EVENTO));
            }
        }

        return $eventStream;
    }

    public function getCuentas():CuentaStream
    {
        $cuentaStream = new CuentaStream();

        foreach (array_keys($this->data) as $despacho_attribute) {
            if (str_starts_with($despacho_attribute, 'CUENTA') === false) continue;
            if ($this->data[$despacho_attribute] === 0.0) continue;
            
            $cuentaStream->add(new DespachoCuenta($this, substr($despacho_attribute, 7), $this->data[$despacho_attribute]));
        }

        return $cuentaStream;
    }

    public function getItems():ItemStream
    {
        $itemStream = new ItemStream();
        if (!array_key_exists('ITEMS', $this->data)) return $itemStream;
        
        $items = $this->data['ITEMS'];
        
        if(is_object($items)) $itemStream->add(new DespachoItem($this, $items->ITEM, $items->PARTIDA_ARANCELARIA, $items->DESCRIPCION, $items->VALOR_CIF, $items->VALOR_FOB, $items->VALOR_FLETE, $items->VALOR_SEGURO, $items->KILOS, $items->CIP));

        if (is_array($items)) {
            $items = Data::trim($items);
            foreach ($items as $item) {
                $itemStream->add(new DespachoItem($this, $item->ITEM, $item->PARTIDA_ARANCELARIA, $item->DESCRIPCION, $item->VALOR_CIF, $item->VALOR_FOB, $item->VALOR_FLETE, $item->VALOR_SEGURO, $item->KILOS, $item->CIP));
            }
        }

        return $itemStream;
    }

    public function getProvision():DespachoProvision
    {
        return new DespachoProvision(
            $this, 
            $this->data['FECHA_PROV'] ?? null,
            $this->data['FECHA_ETA'] ?? null,
            $this->data['TIPO_CAMBIO'] ?? 0.0,
            $this->data['TOTAL_GCP_PESOS'] ?? 0,
            $this->data['TOTAL_GCP_USD'] ?? 0.0,
            $this->data['TOTAL_PROV'] ?? 0,
            $this->data['DESEMBOLSOS'] ?? 0,
            $this->data['VALOR_CIF'] ?? 0.0,
            $this->getAduana(),
            trim($this->data['NAVE']) ?? null
        );

    }
}
