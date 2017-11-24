<?php

namespace BlenderBundle\Player;


interface IPlayerState
{

    public function meetCellSouth();

    public function meetCellEast();

    public function meetCellNorth();

    public function meetCellWest();

    public function meetCellEnd();

    public function meetCellInverter();

    public function meetCellTeleporter();

    public function meetCellUnbreakable();

    public function meetCellBreakable();

    public function meetCellBeer();

    public function meetCellEmpty();
}