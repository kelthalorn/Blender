<?php

namespace BlenderBundle\Cell;

class BreakableCell extends AbstractCell
{
    public function __construct($isPlayerPos)
    {
        parent::__construct($isPlayerPos);
        $this->isBreakable = true;
        $this->symbol = "X";
    }
}