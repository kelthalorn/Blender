<?php

namespace BlenderBundle\Tools;


use BlenderBundle\Cell\AbstractCell;
use BlenderBundle\Cell\Cell;
use BlenderBundle\Constant\BlenderConstant;
use BlenderBundle\Player\Player;

class Map
{
    /**
     * @var array<AbstractCell>
     */
    private $map;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @var Player
     */
    private $player;

    /**
     * @var Cell
     */
    private $cellFactory;

    /**
     * MapTool constructor.
     * @param int $width
     * @param int $height
     * @param array $mapJson
     */
    public function __construct($width, $height, $mapJson)
    {
        $this->cellFactory = new Cell();
        $this->player = new Player();

        $this->width    = $width-1;
        $this->height   = $height-1;

        $this->initMap($mapJson);
    }

    /**
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    public function setPlayerDead() {

        $this->player->setPlayerDead();
    }

    private function initMap($mapJson) {

        for ($colIndex = 0; $colIndex <= $this->height; $colIndex++) {

            $tabCol = array();
            for ($lineIndex = 0; $lineIndex <= $this->width; $lineIndex++) {

                $tabCol[] = $this->getCellBySymbol($mapJson[$colIndex][$lineIndex]);

                if ($mapJson[$colIndex][$lineIndex] == '@') {

                    $this->player->setPosX($lineIndex);
                    $this->player->setPosY($colIndex);
                }
            }
            $this->map[] = $tabCol;
        }
    }

    /**
     * @param string $symbol
     * @return \BlenderBundle\Cell\AbstractCell
     */
    public function getCellBySymbol($symbol) {

        $parseData = $this->parseSymbolToPrefix($symbol);

        return $this->cellFactory::getCell($parseData['prefix'], $parseData['isPlayerPos']);
    }

    /**
     * @param string $symbol
     * @return array
     */
    private function parseSymbolToPrefix($symbol) {

        $isPlayerPos = false;

        switch ($symbol) {

            case " " :  $prefix = "Empty";
                        break;
            case "#" :  $prefix = "Unbreakable";
                        break;
            case "S" :  $prefix = "South";
                        break;
            case "E" :  $prefix = "East";
                        break;
            case "N" :  $prefix = "North";
                        break;
            case "W" :  $prefix = "West";
                        break;
            case "I" :  $prefix = "Inverter";
                        break;
            case "T" :  $prefix = "Teleporter";
                        break;
            case "X" :  $prefix = "Breakable";
                        break;
            case "B" :  $prefix = "Beer";
                        break;
            case "$" :  $prefix = "End";
                        break;
            case "@" :  $prefix = "Empty";
                        $isPlayerPos = true;
                        break;
            default :   $prefix = "Unbreakable";
                        break;
        }
        
        return array('prefix' => $prefix, 'isPlayerPos' => $isPlayerPos);
    }
    
    public function checkNextMove() {

        $nextPosX = $this->player->getPosX();
        $nextPosY = $this->player->getPosY();

        switch ($this->player->getDirection()) {

            case "South" :  $nextPosY++;
                            break;
            case "East" :   $nextPosX++;
                            break;
            case "North" :  $nextPosY--;
                            break;
            case "West" :   $nextPosX--;
                            break;
        }
        
        $nextCell = $this->getCellByPos($nextPosX, $nextPosY);

        if ($this->playerCanContinue($nextCell, $nextPosX, $nextPosY)) {

            $this->map[$this->player->getPosY()][$this->player->getPosX()]->setPlayerPos(false);

            $this->player->setPosX($nextPosX);
            $this->player->setPosY($nextPosY);

            $this->map[$this->player->getPosY()][$this->player->getPosX()]->setPlayerPos(true);
            return;
        }

        $currentDirectionIndex = array_search($this->player->getDirection(), $this->player->getDirectionOrder());
        
        $nextDirectionIndex = $currentDirectionIndex+1;
        if ($nextDirectionIndex >= count($this->player->getDirectionOrder()))
            $nextDirectionIndex = 0;
        
        $nextDirection = $this->player->getDirectionOrder()[$nextDirectionIndex];
        
        
        $this->player->setDirection($nextDirection);
    }

    /**
     * @param AbstractCell $cell
     * @param int $cellPosX
     * @param int $cellPosY
     * @return bool
     */
    private function playerCanContinue(AbstractCell $cell, $cellPosX, $cellPosY) {
    
        $parseData = $this->parseSymbolToPrefix($cell->getSymbol());

        $methodName = "meetCell".$parseData['prefix'];
        $playerResult =  $this->player->$methodName();
        
        if (isset($playerResult['changeCellTypeTo'])) {
        
            if (!in_array($playerResult['changeCellTypeTo'], BlenderConstant::AVAILABLE_CELL_TYPE)) {
                
                var_dump("C'EST LA MOUISE. CELL TYPE INCONNU : ".$playerResult['changeCellTypeTo']);
                die();
            }
            
            $this->map[$cellPosY][$cellPosX] = $this->cellFactory::getCell($playerResult['changeCellTypeTo'], true);
        }
        
        return $playerResult['canContinue'];
    }

    /**
     * @param int $posX
     * @param int $posY
     * @return AbstractCell
     */
    private function getCellByPos($posX, $posY) {
        
        return $this->map[$posY][$posX];
    }
    
    /******************************************************* DEBUG METHODS *****************************************************************/

    public function displayMap() {

        for ($colIndex = 0; $colIndex <= $this->height; $colIndex++) {

            $lineSymbol = "";
            for ($lineIndex = 0; $lineIndex <= $this->width; $lineIndex++) {

                $cell = $this->map[$colIndex][$lineIndex];
                $lineSymbol .= $cell->getSymbol();
            }
            var_dump($lineSymbol);
        }
    }

    public function displayPlayerPos() {

        $this->player->displayPos();
    }
}