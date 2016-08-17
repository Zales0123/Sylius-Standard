<?php

namespace UrbanaraBundle\Exception;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class UnexistingClientException extends \InvalidArgumentException
{
    /**
     * @param string $clientIdentifier
     */
    public function __construct($clientIdentifier)
    {
        parent::__construct(sprintf('Client with identifier "%s" does not exist.', $clientIdentifier));
    }
}
