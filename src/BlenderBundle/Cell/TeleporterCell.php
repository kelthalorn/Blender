<?php

namespace BlenderBundle\Cell;


class TeleporterCell extends AbstractCell
{
    public function __construct($isPlayerPos)
    {
        parent::__construct($isPlayerPos);
        $this->isTeleporter = true;
        $this->symbol = "T";
    }
}