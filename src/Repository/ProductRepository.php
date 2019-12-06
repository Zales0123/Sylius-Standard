<?php

declare(strict_types=1);

namespace App\Repository;

use Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductRepository as BaseProductRepository;
use Tataragne\SyliusAutomatedAssociationPlugin\Repository\ProductRepositoryInterface;
use Tataragne\SyliusAutomatedAssociationPlugin\Repository\ProductRepositoryTrait;

class ProductRepository extends BaseProductRepository implements ProductRepositoryInterface
{
    use ProductRepositoryTrait;
}
