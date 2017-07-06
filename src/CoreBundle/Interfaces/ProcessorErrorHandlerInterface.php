<?php

namespace Microservice\CoreBundle\Interfaces;

use Microservice\CoreBundle\Message\QueueMessage;

interface ProcessorErrorHandlerInterface {
    /**
     * @param QueueMessage $message
     * @param \Exception $e
     */
    public function onError(QueueMessage $message, \Exception $e) : void;
}