<?php

namespace spec\UrbanaraBundle\Driver;

use PhpSpec\ObjectBehavior;
use UrbanaraBundle\Client\SyliusClient;
use UrbanaraBundle\Driver\OrderDriverInterface;
use UrbanaraBundle\Driver\SyliusClientDriver;

/**
 * @mixin SyliusClientDriver
 *
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class SyliusClientDriverSpec extends ObjectBehavior
{
    function let(SyliusClient $syliusClient)
    {
        $this->beConstructedWith($syliusClient);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('UrbanaraBundle\Driver\SyliusClientDriver');
    }

    function it_implements_order_driver_interface()
    {
        $this->shouldImplement(OrderDriverInterface::class);
    }

    function it_uses_sylius_client_to_return_requested_order_status(SyliusClient $syliusClient)
    {
        $syliusClient->checkStatus(1)->willReturn('pending');

        $this->checkStatus(1)->shouldReturn('pending');
    }
}
