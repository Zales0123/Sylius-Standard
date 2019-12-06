<?php

declare(strict_types=1);

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Product\Model\ProductAssociationType as BaseProductAssociationType;
use Sylius\Component\Product\Model\ProductAssociationTypeTranslationInterface;
use Tataragne\SyliusAutomatedAssociationPlugin\Entity\AssociationTypeInterface;
use Tataragne\SyliusAutomatedAssociationPlugin\Entity\AssociationTypeTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_product_association_type")
 */
class ProductAssociationType extends BaseProductAssociationType implements AssociationTypeInterface
{
    use AssociationTypeTrait {
        __construct as private initializeRulesCollections;
    }

    public function __construct()
    {
        parent::__construct();
        $this->initializeRulesCollections();
    }

    protected function createTranslation(): ProductAssociationTypeTranslationInterface
    {
        return new ProductAssociationTypeTranslation();
    }
}
