<?php

namespace UrbanaraBundle\Client;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
interface OrderClientInterface
{
    /**
     * @param int $orderId
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function checkStatus($orderId);
}
