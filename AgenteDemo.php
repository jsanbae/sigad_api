<?php

use Jsanbae\SigadAPI\ClienteSIGAD;

class AgenteDemo extends ClienteSIGAD
{
    public function getCodigo():string
    {
        $codigo = 'A01';

        return $codigo;
    }

    public function getNombre():string
    {
        $nombre = 'JUANITO DEMO';
        
        return $nombre;
    }

    public function getRut():string
    {
        $rut = 123456789;

        return $rut;
    }

    public function getRutAgencia():string
    {
        $rut = 99999999;

        return $rut;
    }

    public function getCredentialEditradeAPI():array
    {
        $credentials = ['login' => 'demo_user', 'password' => 'demo_pass'];

        return $credentials;
    }

    public function getBaseURLEditradeAPI():string
    {
        $base_url_api = 'https://demo.editrade.cl/SigadIEDDEMO';

        return $base_url_api;
    }

}
