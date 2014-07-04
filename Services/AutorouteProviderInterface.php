<?php

namespace Netgusto\AutorouteBundle\Services;

use Symfony\Component\Config\Loader\LoaderResolverInterface;

interface AutorouteProviderInterface {
    public function getRouteCollection(LoaderResolverInterface $resolver);
}