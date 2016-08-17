<?php

namespace spec\UrbanaraBundle\Connector;

use PhpSpec\ObjectBehavior;
use UrbanaraBundle\Checker\OrdersStatusesChecker;
use UrbanaraBundle\Connector\ShopConnector;
use UrbanaraBundle\Driver\OrderDriver;

/**
 * @mixin ShopConnector
 *
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class ShopConnectorSpec extends ObjectBehavior
{
    function let(OrdersStatusesChecker $ordersStatusesChecker)
    {
        $this->beConstructedWith($ordersStatusesChecker);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('UrbanaraBundle\Connector\ShopConnector');
    }

    function it_uses_order_statuses_checker_to_check_order_status(OrdersStatusesChecker $ordersStatusesChecker)
    {
        $ordersStatusesChecker->checkOrderStatus('dummy_client', 10)->willReturn('new');;

        $this->checkOrderStatus('dummy_client', 10)->shouldReturn('new');;
    }

    function it_can_check_multiple_orders_statuses_as_once(OrdersStatusesChecker $ordersStatusesChecker)
    {
        $ordersStatusesChecker
            ->checkOrdersStatuses('client_id', [1, 3, 5])
            ->willReturn([1 => 'new', 3 => 'pending', 5 => 'cancelled'])
        ;

        $this
            ->checkOrdersStatuses('client_id', [1, 3, 5])
            ->shouldReturn([1 => 'new', 3 => 'pending', 5 => 'cancelled'])
        ;
    }
}
