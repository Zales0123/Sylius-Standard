<?php

namespace UrbanaraBundle\Driver;

use UrbanaraBundle\Client\SyliusClient;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class SyliusClientDriver implements OrderDriverInterface
{
    /**
     * @var SyliusClient
     */
    private $syliusDriver;

    /**
     * @param SyliusClient $syliusDriver
     */
    public function __construct(SyliusClient $syliusDriver)
    {
        $this->syliusDriver = $syliusDriver;
    }

    /**
     * {@inheritdoc}
     */
    public function checkStatus($orderId)
    {
        return $this->syliusDriver->checkStatus($orderId);
    }
}
