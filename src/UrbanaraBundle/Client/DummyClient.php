<?php

namespace UrbanaraBundle\Client;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class DummyClient implements OrderClientInterface
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
     * {@inheritdoc}
     */
    public function checkStatus($orderId)
    {
        if (!array_key_exists($orderId, self::$statuses)) {
            throw new \InvalidArgumentException(sprintf('Order with ID %d does not exist.', $orderId));
        }

        return self::$statuses[$orderId];
    }
}
