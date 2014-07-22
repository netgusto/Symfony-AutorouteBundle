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
        if($this->resourcepath{0} === '\\' && $this->resourcepath{1} === '@') {
            $this->resourcepath = ltrim($this->resourcepath, '\\');
        }
    }

    public function getRouteCollection(FileLocator $fileLocator, LoaderResolverInterface $resolver) {
        $loader = new YamlFileLoader(new FileLocator());
        $loader->setResolver($resolver);
        return $loader->load(
            $fileLocator->locate($this->resourcepath)
        );
    }
}