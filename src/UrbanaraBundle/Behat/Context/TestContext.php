<?php

namespace UrbanaraBundle\Behat\Context;

use Behat\Behat\Context\Context;
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
     * @param CheckStatusPage $checkStatusPage
     */
    public function __construct(CheckStatusPage $checkStatusPage)
    {
        $this->checkStatusPage = $checkStatusPage;
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
}
