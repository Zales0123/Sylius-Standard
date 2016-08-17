<?php

namespace UrbanaraBundle\Connector;

use UrbanaraBundle\Checker\OrdersStatusesChecker;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class ShopConnector
{
    /**
     * @var OrdersStatusesChecker
     */
    private $orderStatusesChecker;

    /**
     * @param OrdersStatusesChecker $ordersStatusesChecker
     */
    public function __construct(OrdersStatusesChecker $ordersStatusesChecker)
    {
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
        return $this->orderStatusesChecker->checkOrderStatus($client, $orderId);
    }

    /**
     * @param string $client
     * @param array $ordersIds
     *
     * @return array
     */
    public function checkOrdersStatuses($client, array $ordersIds)
    {
        return $this->orderStatusesChecker->checkOrdersStatuses($client, $ordersIds);
    }
}
