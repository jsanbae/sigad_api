<?php

namespace Jsanbae\SigadAPI\Events;

use Jsanbae\SigadAPI\Event;

class EventoDinamico implements Event
{
    private $codigo;

    public function __construct($_codigo)
    {
        $this->codigo = $_codigo;
    }

    public function getCodigo():string
    {
        return $this->codigo;
    }
}