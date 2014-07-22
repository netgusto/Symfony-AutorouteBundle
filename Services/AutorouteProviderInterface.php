<?php

namespace Netgusto\AutorouteBundle\Services;

use Symfony\Component\Config\Loader\LoaderResolverInterface,
    Symfony\Component\Config\FileLocator;

interface AutorouteProviderInterface {
    public function getRouteCollection(FileLocator $fileLocator, LoaderResolverInterface $resolver);
}