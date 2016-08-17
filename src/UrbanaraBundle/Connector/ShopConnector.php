<?php

namespace UrbanaraBundle\Connector;

use UrbanaraBundle\Checker\OrdersStatusesChecker;
use UrbanaraBundle\Driver\OrderDriver;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class ShopConnector
{
    /**
     * @var OrderDriver
     */
    private $orderDriver;

    /**
     * @var OrdersStatusesChecker
     */
    private $orderStatusesChecker;

    /**
     * @param OrderDriver $orderDriver
     * @param OrdersStatusesChecker $ordersStatusesChecker
     */
    public function __construct(OrderDriver $orderDriver, OrdersStatusesChecker $ordersStatusesChecker)
    {
        $this->orderDriver = $orderDriver;
        $this->orderStatusesChecker = $ordersStatusesChecker;
    }

    /**
     * @param string $client
     * @param int $orderId
     *
     * @return string
     */
    public function checkOrderStatus($client, $orderId)
    {
        return $this->orderDriver->checkStatus($client, $orderId);
    }

    /**
     * @param string $client
     * @param array $ordersIds
     *
     * @return array
     */
    public function checkOrdersStatuses($client, array $ordersIds)
    {
        return $this->orderStatusesChecker->checkOrderStatuses($client, $ordersIds);
    }
}
