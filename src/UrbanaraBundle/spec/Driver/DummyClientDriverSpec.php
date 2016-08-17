<?php

namespace spec\UrbanaraBundle\Driver;

use PhpSpec\ObjectBehavior;
use UrbanaraBundle\Client\DummyClient;
use UrbanaraBundle\Driver\OrderDriverInterface;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class DummyClientDriverSpec extends ObjectBehavior
{
    function let(DummyClient $dummyClient)
    {
        $this->beConstructedWith($dummyClient);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('UrbanaraBundle\Driver\DummyClientDriver');
    }

    function it_implements_order_driver_interface()
    {
        $this->shouldImplement(OrderDriverInterface::class);
    }

    function it_uses_proper_driver_to_return_order_status(DummyClient $dummyClient)
    {
        $dummyClient->checkStatus(10)->willReturn('{"status":"new"}');

        $this->checkStatus(10)->shouldReturn('new');
    }
}
