<?php

namespace spec\UrbanaraBundle\Connector;

use PhpSpec\ObjectBehavior;
use UrbanaraBundle\Driver\OrderDriver;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class ShopConnectorSpec extends ObjectBehavior
{
    function let(OrderDriver $orderDriver)
    {
        $this->beConstructedWith($orderDriver);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('UrbanaraBundle\Connector\ShopConnector');
    }

    function it_uses_order_driver_to_check_order_status(OrderDriver $orderDriver)
    {
        $orderDriver->checkStatus('dummy_client', 10)->willReturn('new');;

        $this->checkOrderStatus('dummy_client', 10)->shouldReturn('new');;
    }
}
