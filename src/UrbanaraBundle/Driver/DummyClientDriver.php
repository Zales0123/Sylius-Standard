<?php

namespace UrbanaraBundle\Driver;

use UrbanaraBundle\Client\DummyClient;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class DummyClientDriver implements OrderDriverInterface
{
    /**
     * @var DummyClient
     */
    private $dummyClient;

    /**
     * @param DummyClient $dummyClient
     */
    public function __construct(DummyClient $dummyClient)
    {
        $this->dummyClient = $dummyClient;
    }

    /**
     * {@inheritdoc}
     */
    public function checkStatus($orderId)
    {
        $response = (array) json_decode($this->dummyClient->checkStatus($orderId));

        return $response['status'];
    }
}
