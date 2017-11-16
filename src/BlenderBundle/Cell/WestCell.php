<?php

namespace BlenderBundle\Cell;


class WestCell extends AbstractCell
{
    public function __construct($isPlayerPos)
    {
        parent::__construct($isPlayerPos);
        $this->isWest = true;
        $this->symbol = "W";
    }
}