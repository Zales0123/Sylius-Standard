<?php

namespace UrbanaraBundle\Driver;

use Sylius\Component\Registry\ServiceRegistryInterface;
use UrbanaraBundle\Client\OrderClientInterface;
use UrbanaraBundle\Exception\UnexistingClientException;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class OrderDriver
{
    /**
     * @var ServiceRegistryInterface
     */
    private $orderClientsRegistry;

    /**
     * @param ServiceRegistryInterface $orderClientsRegistry
     */
    public function __construct(ServiceRegistryInterface $orderClientsRegistry)
    {
        $this->orderClientsRegistry = $orderClientsRegistry;
    }

    /**
     * @param string $driver
     * @param int $orderId
     *
     * @return string
     *
     * @throws UnexistingClientException
     */
    public function checkStatus($driver, $orderId)
    {
        if (!$this->orderClientsRegistry->has($driver)) {
            throw new UnexistingClientException($driver);
        }

        /** @var OrderClientInterface $orderClient */
        $orderClient = $this->orderClientsRegistry->get($driver);

        return $orderClient->checkStatus($orderId);
    }
}
