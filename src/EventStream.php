<?php

namespace Jsanbae\SigadAPI;

use Jsanbae\SigadAPI\Event;

class EventStream
{
    private $events = [];

    public function add(Event $_evento):void
    {
        $this->events[] = $_evento;
    }

    public function list():array
    {
        return $this->events;
    }

    public function filteredByTypes(array $types):array
    {
        return array_filter($this->events, function ($event) use ($types) {
            return in_array($event->getCodigo(), $types);
        });
    }

    public function hasEventType(string $type):bool
    {
        return count($this->filteredByTypes([$type])) > 0;
    }

    public function hasEvents():bool
    {
        return count($this->events) > 0;
    }

    public function isEmpty():bool
    {
        return count($this->events) === 0;
    }
}
