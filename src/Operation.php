<?php

namespace Jsanbae\SigadAPI;

use SoapClient;

abstract class Operation
{
    private $service; 

    public function __construct(SoapClient $_service)
    {
        $this->service = $_service;
    }

    protected function getService():SoapClient
    {
        return $this->service;
    }
}
