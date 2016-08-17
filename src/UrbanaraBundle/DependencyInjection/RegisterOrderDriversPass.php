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
class RegisterOrderDriversPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('urbanara.registry.order_driver')) {
            return;
        }

        $registry = $container->getDefinition('urbanara.registry.order_driver');

        $driversServices = $container->findTaggedServiceIds('urbanara.order_driver');
        ksort($driversServices);

        foreach ($driversServices as $id => $attributes) {
            if (!isset($attributes[0]['client'])) {
                throw new \InvalidArgumentException('Tagged driver needs to have `client` attribute.');
            }

            $registry->addMethodCall('register', [$attributes[0]['client'], new Reference($id)]);
        }
    }
}
