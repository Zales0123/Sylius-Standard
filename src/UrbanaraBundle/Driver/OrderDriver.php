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
     * @param string $client
     * @param int $orderId
     *
     * @return string
     *
     * @throws UnexistingClientException
     */
    public function checkStatus($client, $orderId)
    {
        if (!$this->orderClientsRegistry->has($client)) {
            throw new UnexistingClientException($client);
        }

        /** @var OrderClientInterface $orderClient */
        $orderClient = $this->orderClientsRegistry->get($client);

        return $orderClient->checkStatus($orderId);
    }
}
