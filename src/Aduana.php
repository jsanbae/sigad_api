<?php

namespace Jsanbae\SigadAPI;

class Aduana
{
    private $codigo;

    public function __construct(int $_codigo)
    {
        $this->codigo = $_codigo;
    }

    public function getNombre():string
    {
        return match ($this->codigo) {
            33 => 'LOS ANDES',
            48 => 'METROPOLITANA',
            55 => 'TALCAHUANO',
            14 => 'ANTOFAGASTA',
            34 => 'VALPARAISO',
            39 => 'SAN ANTONIO',
            default => 'Aduana desconocida ('.$this->codigo.')',
        };
    }
}
