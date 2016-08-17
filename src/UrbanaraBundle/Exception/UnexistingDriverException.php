<?php

namespace UrbanaraBundle\Exception;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class UnexistingDriverException extends \InvalidArgumentException
{
    /**
     * @param string $clientIdentifier
     */
    public function __construct($clientIdentifier)
    {
        parent::__construct(sprintf('Driver for client "%s" does not exist.', $clientIdentifier));
    }
}
