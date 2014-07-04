<?php

namespace Netgusto\AutorouteBundle\Services;

use Symfony\Component\Config\Loader\LoaderResolverInterface,
    Symfony\Component\Config\Loader\LoaderResolver,
    Symfony\Component\Config\Loader\LoaderInterface,
    Symfony\Component\Routing\Route,
    Symfony\Component\Routing\RouteCollection;

use Netgusto\AutorouteBundle\Services\AutorouteProviderInterface;

class AutorouteService implements LoaderInterface {

    protected $autorouteproviders;

    public function __construct() {
        $this->autorouteproviders = array();
    }

    public function addAutorouteProvider(AutorouteProviderInterface $autorouteprovider, $prefix = null) {
        $this->autorouteproviders[] = array(
            'provider' => $autorouteprovider,
            'prefix' => $prefix
        );
    }

    public function load($resource, $type = null) {
        
        $routecollection = new RouteCollection();

        reset($this->autorouteproviders);
        foreach($this->autorouteproviders as $autorouteprovider) {

            $routes = $autorouteprovider['provider']->getRouteCollection(
                $this->getResolver()
            );
            
            if(!is_null($autorouteprovider['prefix'])) {
                $routes->addPrefix($autorouteprovider['prefix']);
            }

            $routecollection->addCollection($routes);
        }

        return $routecollection;
    }

    public function supports($resource, $type = null) {
        return $type === 'autoroute';
    }

    public function getResolver() {
        return $this->resolver;
    }

    public function setResolver(LoaderResolverInterface $resolver) {
        $this->resolver = $resolver;
    }
}