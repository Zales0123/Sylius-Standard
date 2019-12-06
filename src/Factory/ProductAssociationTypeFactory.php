<?php

declare(strict_types=1);

namespace App\Factory;

use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Translation\Provider\TranslationLocaleProviderInterface;
use Tataragne\SyliusAutomatedAssociationPlugin\Factory\AssociationTypeFactoryInterface;
use Tataragne\SyliusAutomatedAssociationPlugin\Factory\AssociationTypeFactoryTrait;

class ProductAssociationTypeFactory implements AssociationTypeFactoryInterface
{
    use AssociationTypeFactoryTrait;

    /** @var FactoryInterface */
    private $factory;

    /** @var TranslationLocaleProviderInterface */
    private $localeProvider;

    public function __construct(FactoryInterface $factory, TranslationLocaleProviderInterface $localeProvider)
    {
        $this->factory = $factory;
        $this->localeProvider = $localeProvider;
    }
}
