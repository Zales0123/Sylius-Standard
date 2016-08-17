<?php

namespace spec\UrbanaraBundle\Client;

use PhpSpec\ObjectBehavior;
use UrbanaraBundle\Client\OrderClientInterface;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class DummyClientSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('UrbanaraBundle\Client\DummyClient');
    }

    function it_implements_order_client_interface()
    {
        $this->shouldImplement(OrderClientInterface::class);
    }

    function it_returns_hardcoded_order_statuses_as_json()
    {
        $firstOrderStatus = json_encode(['status' => 'new']);
        $secondOrderStatus = json_encode(['status' => 'pending']);
        $thirdOrderStatus = json_encode(['status' => 'cancelled']);

        $this->checkStatus(1)->shouldReturn($firstOrderStatus);
        $this->checkStatus(2)->shouldReturn($secondOrderStatus);
        $this->checkStatus(3)->shouldReturn($thirdOrderStatus);
    }

    function it_throws_exception_if_order_with_given_id_does_not_exist()
    {
        $this
            ->shouldThrow(new \InvalidArgumentException('Order with ID 10 does not exist.'))
            ->during('checkStatus', [10])
        ;
    }
}
