<?php

namespace Jsanbae\SigadAPI\Events;

use Jsanbae\SigadAPI\Event;

class DeclaracionAnulada implements Event
{
    public function getCodigo():string
    {
        return 'ED20';
    }
}