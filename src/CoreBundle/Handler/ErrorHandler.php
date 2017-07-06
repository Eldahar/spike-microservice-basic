<?php

namespace Microservice\CoreBundle\Handler;

use Microservice\CoreBundle\Interfaces\ProcessorErrorHandlerInterface;
use Microservice\CoreBundle\Message\QueueMessage;

class ErrorHandler implements ProcessorErrorHandlerInterface {

    /**
     * @param QueueMessage $message
     * @param \Exception $e
     */
    public function onError(QueueMessage $message, \Exception $e): void {
        // TODO: Implement onError() method.
    }
}