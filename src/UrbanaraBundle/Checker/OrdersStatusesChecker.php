<?php

namespace UrbanaraBundle\Checker;

use Sylius\Component\Registry\ServiceRegistryInterface;
use UrbanaraBundle\Driver\OrderDriverInterface;
use UrbanaraBundle\Exception\UnexistingDriverException;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class OrdersStatusesChecker
{
    /**
     * @var ServiceRegistryInterface
     */
    private $orderDriversRegistry;

    /**
     * @param ServiceRegistryInterface $orderDriversRegistry
     */
    public function __construct(ServiceRegistryInterface $orderDriversRegistry)
    {
        $this->orderDriversRegistry = $orderDriversRegistry;
    }

    /**
     * @param string $client
     * @param int $orderId
     *
     * @return string
     */
    public function checkOrderStatus($client, $orderId)
    {
        return $this->getDriverForClient($client)->checkStatus($orderId);
    }

    /**
     * @param string $client
     * @param array $ordersIds
     *
     * @return array
     */
    public function checkOrdersStatuses($client, array $ordersIds)
    {
        $orderDriver = $this->getDriverForClient($client);

        $statuses = [];

        foreach ($ordersIds as $orderId) {
            try {
                $status = $orderDriver->checkStatus($orderId);
            } catch (\InvalidArgumentException $exception) {
                continue;
            }

            $statuses[$orderId] = $status;
        }

        return $statuses;
    }

    /**
     * @param string $client
     *
     * @return OrderDriverInterface
     */
    private function getDriverForClient($client)
    {
        if (!$this->orderDriversRegistry->has($client)) {
            throw new UnexistingDriverException($client);
        }

        return $this->orderDriversRegistry->get($client);
    }
}
