<?php

namespace spec\UrbanaraBundle\Client;

use PhpSpec\ObjectBehavior;
use UrbanaraBundle\Driver\DummyClientDriver;

/**
 * @mixin DummyClientDriver
 *
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class DummyClientSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('UrbanaraBundle\Client\DummyClient');
    }

    function it_returns_hardcoded_order_statuses_as_json()
    {
        $this->checkStatus(1)->shouldReturn('{"status":"new"}');
        $this->checkStatus(2)->shouldReturn('{"status":"pending"}');
        $this->checkStatus(3)->shouldReturn('{"status":"cancelled"}');
    }

    function it_throws_exception_if_order_with_given_id_does_not_exist()
    {
        $this
            ->shouldThrow(new \InvalidArgumentException('Order with ID 10 does not exist.'))
            ->during('checkStatus', [10])
        ;
    }
}
