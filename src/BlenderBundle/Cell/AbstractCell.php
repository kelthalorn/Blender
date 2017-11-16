<?php

namespace BlenderBundle\Cell;

abstract class AbstractCell
{
    /**
     * @var bool
     */
    protected $isSouth;

    /**
     * @var bool
     */
    protected $isEast;

    /**
     * @var bool
     */
    protected $isNorth;

    /**
     * @var bool
     */
    protected $isWest;

    /**
     * @var bool
     */
    protected $isUnbreakable;

    /**
     * @var bool
     */
    protected $isBreakable;

    /**
     * @var bool
     */
    protected $isInverter;

    /**
     * @var bool
     */
    protected $isTeleporter;

    /**
     * @var bool
     */
    protected $isEnd;

    /**
     * @var bool
     */
    protected $isBeer;

    /**
     * @var bool
     */
    protected $isEmpty;

    /**
     * @var string
     */
    protected $symbol;

    /**
     * @var bool
     */
    protected $isPlayerPos;

    public function __construct($isPlayerPos) {

        $this->isSouth          = false;
        $this->isEast           = false;
        $this->isNorth          = false;
        $this->isWest           = false;
        $this->isUnbreakable    = false;
        $this->isBreakable      = false;
        $this->isInverter       = false;
        $this->isTeleporter     = false;
        $this->isBeer           = false;
        $this->isEnd            = false;
        $this->isEmpty          = false;
        $this->symbol           = "";
        $this->isPlayerPos      = $isPlayerPos;
    }

    /**
     * @param bool $isPlayerPos
     */
    public function setPlayerPos($isPlayerPos) {

        $this->isPlayerPos = $isPlayerPos;
    }

    /**
     * @return bool
     */
    public function isSouth() {

        return $this->isSouth;
    }

    /**
     * @return bool
     */
    public function isEast() {

        return $this->isEast;
    }

    /**
     * @return bool
     */
    public function isNorth() {

        return $this->isNorth;
    }

    /**
     * @return bool
     */
    public function isWest() {

        return $this->isWest;
    }

    /**
     * @return bool
     */
    public function isUnbreakable() {

        return $this->isUnbreakable;
    }

    /**
     * @return bool
     */
    public function isBreakable() {

        return $this->isBreakable;
    }

    /**
     * @return bool
     */
    public function isInverter() {

        return $this->isInverter;
    }

    /**
     * @return bool
     */
    public function isTeleporter() {

        return $this->isTeleporter;
    }

    /**
     * @return bool
     */
    public function isBeer() {

        return $this->isBeer;
    }

    /**
     * @return bool
     */
    public function isEnd() {

        return $this->isEnd;
    }

    /**
     * @return bool
     */
    public function isEmpty() {
        
        return $this->isEmpty;
    }

    /**
     * @return string
     */
    public function getSymbol() {

        if (!$this->isPlayerPos)
            return $this->symbol;

        return '@';
    }

    /**
     * @return bool
     */
    public function isPlayerPos() {
        
        return $this->isPlayerPos;
    }
}