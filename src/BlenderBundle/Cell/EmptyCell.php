<?php

namespace BlenderBundle\Cell;


class EmptyCell extends AbstractCell
{
    public function __construct($isPlayerPos)
    {
        parent::__construct($isPlayerPos);
        $this->isEmpty = true;
        $this->symbol = " ";
    }
}