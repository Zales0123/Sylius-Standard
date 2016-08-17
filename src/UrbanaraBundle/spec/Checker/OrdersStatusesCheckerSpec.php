<?php

namespace spec\UrbanaraBundle\Checker;

use PhpSpec\ObjectBehavior;
use Sylius\Component\Registry\ServiceRegistryInterface;
use UrbanaraBundle\Checker\OrdersStatusesChecker;
use UrbanaraBundle\Driver\OrderDriver;
use UrbanaraBundle\Driver\OrderDriverInterface;
use UrbanaraBundle\Exception\UnexistingDriverException;

/**
 * @mixin OrdersStatusesChecker
 *
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class OrdersStatusesCheckerSpec extends ObjectBehavior
{
    function let(ServiceRegistryInterface $orderDriversRegistry)
    {
        $this->beConstructedWith($orderDriversRegistry);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('UrbanaraBundle\Checker\OrdersStatusesChecker');
    }

    function it_checks_status_for_one_specific_order(
        OrderDriverInterface $orderDriver,
        ServiceRegistryInterface $orderDriversRegistry
    ) {
        $orderDriversRegistry->has('client_id')->willReturn(true);
        $orderDriversRegistry->get('client_id')->willReturn($orderDriver);

        $orderDriver->checkStatus(1)->willReturn('new');

        $this->checkOrderStatus('client_id', 1)->shouldReturn('new');
    }

    function it_checks_for_statuses_of_all_orders_which_ids_has_been_passed(
        OrderDriverInterface $orderDriver,
        ServiceRegistryInterface $orderDriversRegistry
    ) {
        $orderDriversRegistry->has('client_id')->willReturn(true);
        $orderDriversRegistry->get('client_id')->willReturn($orderDriver);

        $orderDriver->checkStatus(1)->willReturn('new');
        $orderDriver->checkStatus(2)->willReturn('pending');
        $orderDriver->checkStatus(3)->willReturn('cancelled');
        $orderDriver->checkStatus(4)->willReturn('new');

        $this->checkOrdersStatuses('client_id', [1, 2, 3, 4])->shouldReturn([
            1 => 'new',
            2 => 'pending',
            3 => 'cancelled',
            4 => 'new',
        ]);;
    }

    function it_does_not_check_status_of_order_which_does_not_exist(
        OrderDriverInterface $orderDriver,
        ServiceRegistryInterface $orderDriversRegistry
    ) {
        $orderDriversRegistry->has('client_id')->willReturn(true);
        $orderDriversRegistry->get('client_id')->willReturn($orderDriver);

        $orderDriver->checkStatus(1)->willReturn('new');
        $orderDriver->checkStatus(2)->willThrow(\InvalidArgumentException::class);
        $orderDriver->checkStatus(3)->willReturn('cancelled');
        $orderDriver->checkStatus(4)->willReturn('new');

        $this->checkOrdersStatuses('client_id', [1, 2, 3, 4])->shouldReturn([
            1 => 'new',
            3 => 'cancelled',
            4 => 'new',
        ]);;
    }

    function it_throws_exception_if_driver_for_given_client_does_not_exist(ServiceRegistryInterface $orderDriversRegistry)
    {
        $orderDriversRegistry->has('unexisting_client')->willReturn(false, false);

        $this
            ->shouldThrow(new UnexistingDriverException('unexisting_client'))
            ->during('checkOrderStatus', ['unexisting_client', 1])
        ;

        $this
            ->shouldThrow(new UnexistingDriverException('unexisting_client'))
            ->during('checkOrdersStatuses', ['unexisting_client', [1, 2, 3]])
        ;
    }
}
