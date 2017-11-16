<?php

namespace BlenderBundle\Cell;


class EndCell extends AbstractCell
{
    public function __construct($isPlayerPos)
    {
        parent::__construct($isPlayerPos);
        $this->isEnd = true;
        $this->symbol = "$";
    }
}