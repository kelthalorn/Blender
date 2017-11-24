<?php

namespace BlenderBundle\Cell;


class BeerCell extends AbstractCell
{
    public function __construct($isPlayerPos)
    {
        parent::__construct($isPlayerPos);
        $this->isBeer = true;
        $this->symbol = "B";
    }
}