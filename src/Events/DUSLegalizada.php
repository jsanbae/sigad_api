<?php

namespace Jsanbae\SigadAPI\Events;

use Jsanbae\SigadAPI\Event;

class DUSLegalizada implements Event
{
    public function getCodigo():string
    {
        return 'ED24';
    }
}