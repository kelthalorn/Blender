<?php

namespace BlenderBundle\Constant;

/**
 * Class BlenderConstant
 * @package BlenderBundle\Constant
 */
class BlenderConstant
{
    CONST BLENDER_RESPONSE_KEY = 'blender';
    CONST BLENDER_LIST_RESPONSE_KEY = 'blenderList';
    
    CONST AVAILABLE_CELL_TYPE = [
        
        "Empty",
        "South",
        "East",
        "North",
        "West",
        "Inverter",
        "Teleporter",
        "Breakable",
        "Unbreakable",
        "End",
        "Beer"
    ];
}