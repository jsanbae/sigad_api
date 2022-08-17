<?php

namespace Jsanbae\SigadAPI\Events;

use Jsanbae\SigadAPI\Event;

class AclaradoAceptado implements Event
{
    public function getCodigo():string
    {
        return 'ED10';
    }
}