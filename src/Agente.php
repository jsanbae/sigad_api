<?php

namespace Jsanbae\SigadAPI;

interface Agente
{
    public function getCodigo():string;
    public function getRUT():string;
    public function getRUTAgencia():string;
    public function getNombre():string;
}
