<?php

namespace Netgusto\AutorouteBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class AutorouteCompilerPass implements CompilerPassInterface {
    
    public function process(ContainerBuilder $container) {
        
        if(!$container->hasDefinition('autoroute')) {
            return;
        }

        $autorouteDefinition = $container->getDefinition('autoroute');
        
        $taggedServices = $container->findTaggedServiceIds('autoroute.provider');
        
        foreach ($taggedServices as $id => $attributes) {

            $attr = $attributes[0];

            if(array_key_exists('prefix', $attr)) {
                $prefix = $attr['prefix'];
            } else {
                $prefix = null;
            }

            $autorouteDefinition->addMethodCall(
                'addAutorouteProvider',
                array(new Reference($id), $prefix)
            );
        }
    }
}