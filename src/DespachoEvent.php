<?php

namespace Jsanbae\SigadAPI;

use Jsanbae\SigadAPI\Despacho;
use Jsanbae\SigadAPI\Event;

class DespachoEvent implements Event
{
    private $despacho;
    private $date;
    private $event;
    private $comments;

    public function __construct(Despacho $_despacho, Event $_event, string $_date, string $_comments = '')
    {
        $this->despacho = $_despacho;
        $this->event = $_event;
        $this->date = $_date;
        $this->comments = $_comments;
    }

    public function getDespacho():Despacho
    {
        return $this->despacho;
    }

    public function getCodigo():string
    {
        return $this->event->getCodigo();
    }

    public function getDate():string
    {
        return $this->date;
    }
    
    public function getComments():string
    {
        return $this->comments;
    }

    public function toArray():array
    {
        return [
            'despacho' => $this->getDespacho()->getNumero(),
            'status' => $this->getCodigo(),
            'fecha' => $this->getDate(),
            'comentario' => $this->getComments(),
        ];
    }

}
