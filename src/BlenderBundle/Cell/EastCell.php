<?php

namespace BlenderBundle\Cell;


class EastCell extends AbstractCell
{
    public function __construct($isPlayerPos)
    {
        parent::__construct($isPlayerPos);
        $this->isEast = true;
        $this->symbol = "E";
    }
}