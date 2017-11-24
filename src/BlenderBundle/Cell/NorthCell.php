<?php

namespace BlenderBundle\Cell;


class NorthCell extends AbstractCell
{
    public function __construct($isPlayerPos)
    {
        parent::__construct($isPlayerPos);
        $this->isNorth = true;
        $this->symbol = "N";
    }
}