<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UrbanaraBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class RegisterClientsPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('urbanara.registry.order_client')) {
            return;
        }

        $registry = $container->getDefinition('urbanara.registry.order_client');

        $checkersServices = $container->findTaggedServiceIds('urbanara.client');
        ksort($checkersServices);

        foreach ($checkersServices as $id => $attributes) {
            if (!isset($attributes[0]['type'])) {
                throw new \InvalidArgumentException('Tagged client needs to have `type` attribute.');
            }

            $registry->addMethodCall('register', [$attributes[0]['type'], new Reference($id)]);
        }
    }
}
