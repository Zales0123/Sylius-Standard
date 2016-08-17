<?php

namespace spec\UrbanaraBundle\Checker;

use PhpSpec\ObjectBehavior;
use UrbanaraBundle\Driver\OrderDriver;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class OrdersStatusesCheckerSpec extends ObjectBehavior
{
    function let(OrderDriver $orderDriver)
    {
        $this->beConstructedWith($orderDriver);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('UrbanaraBundle\Checker\OrdersStatusesChecker');
    }

    function it_checks_for_statuses_of_all_orders_which_ids_has_been_passed(OrderDriver $orderDriver)
    {
        $orderDriver->checkStatus('client_id', 1)->willReturn('new');
        $orderDriver->checkStatus('client_id', 2)->willReturn('pending');
        $orderDriver->checkStatus('client_id', 3)->willReturn('cancelled');
        $orderDriver->checkStatus('client_id', 4)->willReturn('new');

        $this->checkOrderStatuses('client_id', [1, 2, 3, 4])->shouldReturn([
            1 => 'new',
            2 => 'pending',
            3 => 'cancelled',
            4 => 'new',
        ]);;
    }

    function it_does_not_check_status_of_order_which_does_not_exist(OrderDriver $orderDriver)
    {
        $orderDriver->checkStatus('client_id', 1)->willReturn('new');
        $orderDriver->checkStatus('client_id', 2)->willThrow(\InvalidArgumentException::class);
        $orderDriver->checkStatus('client_id', 3)->willReturn('cancelled');
        $orderDriver->checkStatus('client_id', 4)->willReturn('new');

        $this->checkOrderStatuses('client_id', [1, 2, 3, 4])->shouldReturn([
            1 => 'new',
            3 => 'cancelled',
            4 => 'new',
        ]);;
    }
}
