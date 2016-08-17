<?php

namespace UrbanaraBundle\Behat\Page;

use Sylius\Behat\Page\SymfonyPage;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class CheckStatusesPage extends SymfonyPage
{
    /**
     * @return array
     */
    public function getStatuses()
    {
        return json_decode($this->getDocument()->getContent(), true);
    }

    /**
     * {@inheritdoc}
     */
    public function getRouteName()
    {
        return 'urbanara_check_orders_statuses';
    }
}
