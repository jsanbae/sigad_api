<?php

namespace Jsanbae\SigadAPI;

class ItemStream
{
    private $items = [];

    public function add(DespachoItem $_item):void
    {
        $this->items[] = $_item;
    }

    public function list():array
    {
        return $this->items;
    }

    public function hasItems():bool
    {
        return count($this->items) > 0;
    }

    public function isEmpty():bool
    {
        return count($this->items) === 0;
    }
}
