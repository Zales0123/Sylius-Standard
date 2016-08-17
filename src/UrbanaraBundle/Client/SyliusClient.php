<?php

namespace UrbanaraBundle\Client;

use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class SyliusClient
{
    /**
     * @var RepositoryInterface
     */
    private $orderRepository;

    /**
     * @param RepositoryInterface $orderRepository
     */
    public function __construct(RepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param int $orderId
     *
     * @return string
     */
    public function checkStatus($orderId)
    {
        /** @var OrderInterface $order */
        $order = $this->orderRepository->findOneBy(['number' => $orderId]);
        if (null === $order) {
            throw new \InvalidArgumentException(sprintf('Order with ID %s does not exist.', $orderId));
        }

        return $order->getState();
    }
}
