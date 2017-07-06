<?php

namespace Microservice\CoreBundle\Driver;

use Microservice\CoreBundle\Interfaces\QueueDriverInterface;
use Microservice\CoreBundle\Message\QueueMessage;

class RabbitMQDriver implements QueueDriverInterface {
    /**
     * @var QueueMessage[]
     */
    protected $messages;

    /**
     */
    public function __construct() {
        $this->messages = [
            new QueueMessage('teszt1'),
            new QueueMessage('teszt2')
        ];
    }


    /**
     * @param int $maximumMessageCount
     *
     * @return QueueMessage[]
     */
    public function getMessages(int $maximumMessageCount): array {
        $messages = [];
        for($currentMessageCount = 0; $currentMessageCount <= $maximumMessageCount ; $currentMessageCount++) {
            if([] == $this->messages) {
                break;
            }
            $messages[] = array_shift($this->messages);
        }

        return $messages;
    }
}