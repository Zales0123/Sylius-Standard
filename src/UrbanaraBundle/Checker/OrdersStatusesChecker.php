<?php

namespace UrbanaraBundle\Checker;

use UrbanaraBundle\Driver\OrderDriver;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class OrdersStatusesChecker
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
     * @param array $ordersIds
     *
     * @return array
     */
    public function checkOrderStatuses($client, array $ordersIds)
    {
        $statuses = [];

        foreach ($ordersIds as $orderId) {
            try {
                $status = $this->orderDriver->checkStatus($client, $orderId);
            } catch (\InvalidArgumentException $exception) {
                continue;
            }

            $statuses[$orderId] = $status;
        }

        return $statuses;
    }
}
