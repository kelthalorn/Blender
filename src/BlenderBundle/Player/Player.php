<?php

namespace BlenderBundle\Player;


class Player implements IPlayerState
{
    /**
     * @var array
     */
    private $directionOrder = ['South', 'East', 'North', 'West'];

    /**
     * @var string
     */
    private $currentDirection;

    /**
     * @var int
     */
    private $posX;

    /**
     * @var int
     */
    private $posY;

    /**
     * @var array
     */
    private $moves;
    
    /**
     * @var bool
     */
    private $isDead;

    /**
     * @var bool
     */
    private $isDrunk;
    
    public function __construct()
    {
        $this->currentDirection = $this->directionOrder[0];
    
        $this->moves    = array();
        $this->isDead   = false;
        $this->isDrunk  = false;

        $this->state = $state;
    }

    /**
     * @param int $posX
     */
    public function setPosX($posX) {

        $this->posX = $posX;
    }

    /**
     * @param int $posY
     */
    public function setPosY($posY) {

        $this->posY = $posY;
    }

    /**
     * @param string $direction
     */
    public function setDirection($direction) {

        if (!in_array($direction, $this->directionOrder)) {

            var_dump("GROS PB DIRECTION ! ! ! !");
            die();
        }

        $this->currentDirection = $direction;
    }

    /**
     * @param string $move
     */
    public function addMove($move) {
        
        $this->moves[] = $move;
    }
    
    public function setPlayerDead() {
        
        $this->isDead = true;
    }

    /**
     * @param bool $isDrunk
     */
    public function setPlayerDrunk($isDrunk) {

        $this->isDrunk = $isDrunk;
    }

    /**
     * @return int
     */
    public function getPosX() {

        return $this->posX;
    }

    /**
     * @return int
     */
    public function getPosY() {

        return $this->posY;
    }

    /**
     * @return string
     */
    public function getDirection() {

        return $this->currentDirection;
    }

    /**
     * @return array
     */
    public function getMoves() {
        
        return $this->moves;
    }

    /**
     * @return array
     */
    public function getDirectionOrder() {
        
        return $this->directionOrder;
    }
    
    public function invertDirectionOrder() {

        $this->directionOrder = array_reverse($this->directionOrder);
    }

    /**
     * @return bool
     */
    public function isPlayerDead() {
        
        return $this->isDead;
    }

    public function displayPos()
    {
        var_dump("PLAYER POS => ".$this->posX.";".$this->posY);
    }

    public function meetCellSouth()
    {
        $this->addMove($this->getDirection());
        $this->setDirection('South');
        return array('canContinue' => true);
    }

    public function meetCellEast()
    {
        $this->addMove($this->getDirection());
        $this->setDirection('East');
        return array('canContinue' => true);
    }

    public function meetCellNorth()
    {
        $this->addMove($this->getDirection());
        $this->setDirection('North');
        return array('canContinue' => true);
    }

    public function meetCellWest()
    {
        $this->addMove($this->getDirection());
        $this->setDirection('West');
        return array('canContinue' => true);
    }

    public function meetCellEnd()
    {
        $this->addMove($this->getDirection());
        $this->setPlayerDead();
        return array('canContinue' => true);
    }

    public function meetCellInverter()
    {
        $this->addMove($this->getDirection());
        $this->invertDirectionOrder();
        return array('canContinue' => true);
    }

    public function meetCellTeleporter()
    {
        $this->addMove($this->getDirection());
        return array('canContinue' => true, 'findTeleporter' => true);
    }

    public function meetCellUnbreakable()
    {
        return array('canContinue' => false);
    }

    /**
     * @return array
     */
    public function meetCellBreakable()
    {

        if (!$this->isDrunk)
            return array('canContinue' => false);
        
        $this->addMove($this->getDirection());
        return array('canContinue' => true, 'changeCellTypeTo' => 'Empty');
    }

    public function meetCellBeer()
    {
        $this->addMove($this->getDirection());
        $this->isDrunk = !$this->isDrunk;
        return array('canContinue' => true);
    }

    public function meetCellEmpty()
    {
        $this->addMove($this->getDirection());
        return array('canContinue' => true);
    }
}