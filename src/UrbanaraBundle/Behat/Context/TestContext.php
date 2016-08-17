<?php

namespace UrbanaraBundle\Behat\Context;

use Behat\Behat\Context\Context;
use UrbanaraBundle\Behat\Page\CheckStatusesPage;
use UrbanaraBundle\Behat\Page\CheckStatusPage;
use Webmozart\Assert\Assert;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class TestContext implements Context
{
    /**
     * @var CheckStatusPage
     */
    private $checkStatusPage;

    /**
     * @var CheckStatusesPage
     */
    private $checkStatusesPage;

    /**
     * @param CheckStatusPage $checkStatusPage
     * @param CheckStatusesPage $checkStatusesPage
     */
    public function __construct(CheckStatusPage $checkStatusPage, CheckStatusesPage $checkStatusesPage)
    {
        $this->checkStatusPage = $checkStatusPage;
        $this->checkStatusesPage = $checkStatusesPage;
    }

    /**
     * @When I want to get status of order :orderId from :client client
     */
    public function iWantToGetStatusOfOrderFromClient($orderId, $client)
    {
        $this->checkStatusPage->open(['client' => $client, 'orderId' => $orderId]);
    }

    /**
     * @Then this order status should be :status
     */
    public function iThisOrderStatusShouldBe($status)
    {
        Assert::eq($status, $this->checkStatusPage->getContent());
    }

    /**
     * @When I want to get status of orders :firstOrder, :secondOrder and :thirdOrder from :client client
     */
    public function iWantToGetStatusOfOrdersAndFromClient($firstOrder, $secondOrder, $thirdOrder, $client)
    {
        $this->checkStatusesPage->open(['client' => $client, 'ordersIds' => [$firstOrder, $secondOrder, $thirdOrder]]);
    }

    /**
     * @Then order :orderId status should be :status
     */
    public function orderStatusShouldBe($orderId, $status)
    {
        $statuses = $this->checkStatusesPage->getStatuses();

        Assert::eq($status, $statuses[$orderId]);
    }
}
