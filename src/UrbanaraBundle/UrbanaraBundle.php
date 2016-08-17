<?php

namespace UrbanaraBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use UrbanaraBundle\DependencyInjection\RegisterClientsPass;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class UrbanaraBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new RegisterClientsPass());
    }
}
