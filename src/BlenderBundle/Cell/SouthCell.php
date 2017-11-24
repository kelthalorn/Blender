<?php

namespace BlenderBundle\Cell;


class SouthCell extends AbstractCell
{
    public function __construct($isPlayerPos)
    {
        parent::__construct($isPlayerPos);
        $this->isSouth = true;
        $this->symbol = "S";
    }
}