<?php

namespace Microservice\CoreBundle\Message;

use Microservice\CoreBundle\Interfaces\QueueMessageInterface;

class QueueMessage implements QueueMessageInterface {
    /**
     * @var string
     */
    protected $messageText;

    public function __construct(string $messageText) {
        $this->messageText = $messageText;
    }

    public function getMessageText(): string {
        return $this->messageText;
    }

}