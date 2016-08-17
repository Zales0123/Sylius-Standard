<?php

namespace UrbanaraBundle\Connector;

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
     * @param OrderDriver $orderDriver
     */
    public function __construct(OrderDriver $orderDriver)
    {
        $this->orderDriver = $orderDriver;
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
}
