<?php

namespace BlenderBundle\Cell;


class InverterCell extends AbstractCell
{
    public function __construct($isPlayerPos)
    {
        parent::__construct($isPlayerPos);
        $this->isInverter = true;
        $this->symbol = "I";
    }
}