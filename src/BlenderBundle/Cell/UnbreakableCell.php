<?php

namespace BlenderBundle\Cell;


class UnbreakableCell extends AbstractCell
{
    public function __construct($isPlayerPos)
    {
        parent::__construct($isPlayerPos);
        $this->isUnbreakable = true;
        $this->symbol = "#";
    }
}