<?php

namespace spec\UrbanaraBundle\Client;

use PhpSpec\ObjectBehavior;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use UrbanaraBundle\Client\OrderClientInterface;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class SyliusClientSpec extends ObjectBehavior
{
    function let(RepositoryInterface $orderRepository)
    {
        $this->beConstructedWith($orderRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('UrbanaraBundle\Client\SyliusClient');
    }

    function it_uses_repository_to_check_order_status(RepositoryInterface $orderRepository, OrderInterface $order)
    {
        $orderRepository->findOneBy(['number' => '0001'])->willReturn($order);
        $order->getState()->willReturn('new');

        $this->checkStatus('0001')->shouldReturn('new');
    }

    function it_throws_exception_if_order_with_given_id_does_not_exit(RepositoryInterface $orderRepository)
    {
        $orderRepository->findOneBy(['number' => '0001'])->willReturn(null);

        $this
            ->shouldThrow(new \InvalidArgumentException('Order with ID 0001 does not exist.'))
            ->during('checkStatus', ['0001'])
        ;
    }
}
