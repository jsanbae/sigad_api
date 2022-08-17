<?php

namespace Jsanbae\SigadAPI\Events;

use Jsanbae\SigadAPI\Event;

class DeclaracionCreada implements Event
{
    public function getCodigo():string
    {
        return 'ED1';
    }
}