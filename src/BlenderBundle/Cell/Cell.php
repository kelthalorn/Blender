<?php

namespace BlenderBundle\Cell;


class Cell
{
    /**
     * @param string $name
     * represents the factory name wanted to be instanciated
     * @return AbstractCell
     */
    public static function getCell($name, $isPlayerPos)
    {
        $name = ucfirst($name);
        $classNamespace = get_class();
        $className = end(explode('\\',$classNamespace));
        $className = '\BlenderBundle\Cell\\'.$name.$className;

        return new $className($isPlayerPos);
    }
}