<?php

namespace UrbanaraBundle\Client;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class DummyClient
{
    /**
     * @var array
     */
    private static $statuses = [
        1 => 'new',
        2 => 'pending',
        3 => 'cancelled',
    ];

    /**
     * @param int $orderId
     *
     * @return string
     */
    public function checkStatus($orderId)
    {
        if (!array_key_exists($orderId, self::$statuses)) {
            throw new \InvalidArgumentException(sprintf('Order with ID %d does not exist.', $orderId));
        }

        return json_encode(['status' => self::$statuses[$orderId]]);
    }
}
