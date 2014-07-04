<?php

namespace Netgusto\AutorouteBundle\Routing;

use Symfony\Component\Routing\Loader\YamlFileLoader,
    Symfony\Component\Config\FileLocator,
    Symfony\Component\Config\Loader\LoaderResolverInterface;

use Netgusto\AutorouteBundle\Services\AutorouteProviderInterface;

class AutorouteProvider implements AutorouteProviderInterface {

    protected $resourcepath;

    public function __construct($resourcepath) {
        $this->resourcepath = $resourcepath;
    }

    public function getRouteCollection(LoaderResolverInterface $resolver) {
        $loader = new YamlFileLoader(new FileLocator());
        $loader->setResolver($resolver);
        return $loader->load($this->resourcepath);
    }
}