<?php

namespace Jsanbae\SigadAPI\Events;

use Jsanbae\SigadAPI\Event;

class DIAceptada implements Event
{
    public function getCodigo():string
    {
        return 'ED8';
    }
}
