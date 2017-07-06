<?php

namespace Microservice\ProcessorBundle\Processor;

use Microservice\CoreBundle\Interfaces\MatchingHandlerInterface;
use Microservice\CoreBundle\Interfaces\ProcessorInterface;
use Microservice\CoreBundle\Interfaces\QueueMessageInterface;

class FirstProcessor implements ProcessorInterface {
    /**
     * @var MatchingHandlerInterface
     */
    protected $matchingHandler;

    public function process(QueueMessageInterface $message) : void {
        printf("Ezen dolgozom: %s\n", $message->getMessageText());
    }
}