<?php

namespace spec\UrbanaraBundle\Driver;

use PhpSpec\ObjectBehavior;
use Sylius\Component\Registry\ServiceRegistryInterface;
use UrbanaraBundle\Client\OrderClientInterface;
use UrbanaraBundle\Exception\UnexistingClientException;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class OrderDriverSpec extends ObjectBehavior
{
    function let(ServiceRegistryInterface $orderClientsRegistry)
    {
        $this->beConstructedWith($orderClientsRegistry);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('UrbanaraBundle\Driver\OrderDriver');
    }

    function it_uses_proper_driver_to_return_order_status(
        OrderClientInterface $client,
        ServiceRegistryInterface $orderClientsRegistry
    ) {
        $orderClientsRegistry->has('dummy')->willReturn(true);
        $orderClientsRegistry->get('dummy')->willReturn($client);

        $client->checkStatus(10)->willReturn('new');

        $this->checkStatus('dummy', 10)->shouldReturn('new');
    }

    function it_throws_exception_if_client_with_given_identifier_does_not_exist(
        ServiceRegistryInterface $orderClientsRegistry
    ) {
        $orderClientsRegistry->has('unexisting_client')->willReturn(false);

        $this
            ->shouldThrow(new UnexistingClientException('unexisting_client'))
            ->during('checkStatus', ['unexisting_client', 10])
        ;
    }
}
