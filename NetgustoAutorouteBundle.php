<?php

namespace Netgusto\AutorouteBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle,
    Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\Compiler\PassConfig;

use Netgusto\AutorouteBundle\DependencyInjection\Compiler\AutorouteCompilerPass;

class NetgustoAutorouteBundle extends Bundle {

    public function build(ContainerBuilder $container) {
        parent::build($container);

        $container->addCompilerPass(
            new AutorouteCompilerPass(),
            PassConfig::TYPE_BEFORE_OPTIMIZATION
        );
    }

}
