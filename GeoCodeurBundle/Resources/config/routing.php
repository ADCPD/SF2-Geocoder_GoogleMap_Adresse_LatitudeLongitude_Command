<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$collection = new RouteCollection();

$collection->add('geo_codeur_homepage', new Route('/', array(
    '_controller' => 'GeoCodeurBundle:Default:index',
)));

return $collection;
