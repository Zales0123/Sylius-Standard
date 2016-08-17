<?php

namespace UrbanaraBundle\Driver;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
interface OrderDriverInterface
{
    /**
     * @param int $orderId
     *
     * @return string
     */
    public function checkStatus($orderId);
}
