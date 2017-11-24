<?php

namespace BlenderBundle\Controller;

use BlenderBundle\Tools\Map;
use BTP\ApiMasterBundle\Controller\ApiMasterController;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class BlenderController
 * @package BlenderBundle\Controller
 */
class BlenderController extends ApiMasterController
{
    /**
     * @param ParamFetcherInterface $paramFetcher
     *
     * @RequestParam(name="width", strict=true, nullable=false, description="map's width"),
     * @RequestParam(name="height", strict=true, nullable=false, description="map's height"),
     * @RequestParam(name="map", strict=true, nullable=false, description="map definition"),
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Get a report template from resource name",
     *
     *  parameters={
     *     {"name"="width", "dataType"="integer", "required"=true, "description"="map's width"},
     *     {"name"="height", "dataType"="integer", "required"=true, "description"="map's height"},
     *     {"name"="map", "dataType"="string", "required"=true, "description"="map definition"},
     *  },
     *
     *  statusCodes={
     *         200="Returned when successful",
     *         400="Returned when bad request",
     *         404="Returned when not found"
     *  }
     * )
     */
    public function postAction(ParamFetcherInterface $paramFetcher) {
        
        $width  = $paramFetcher->get('width');
        $height = $paramFetcher->get('height');
        $mapJson = $paramFetcher->get('map');

        $map = new Map($width, $height, $mapJson);

        $map->displayPlayerPos();
        $map->displayMap();

        while(!$map->getPlayer()->isPlayerDead()) {

            $map->checkNextMove($map->getPlayer()->getDirection());
            /**
             * LOG MOVES AND MAP EVOLUTION
             */
            $map->displayPlayerPos();
            $map->displayMap();
            

        }

        var_dump($map->getPlayer()->getMoves());
        die();
    }
}
