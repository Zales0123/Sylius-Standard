<?php

namespace UrbanaraBundle\Behat\Page;

use Sylius\Behat\Page\SymfonyPage;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class CheckStatusPage extends SymfonyPage
{
    /**
     * @return string
     */
    public function getContent()
    {
        return $this->getDocument()->getContent();
    }

    /**
     * {@inheritdoc}
     */
    public function getRouteName()
    {
        return 'urbanara_check_order_status';
    }
}
