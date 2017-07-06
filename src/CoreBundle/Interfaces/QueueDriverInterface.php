<?php

namespace Microservice\CoreBundle\Interfaces;

use Microservice\CoreBundle\Message\QueueMessage;

interface QueueDriverInterface {
    /**
     * @param int $maximumMessageCount
     *
     * @return QueueMessage[]
     */
    public function getMessages(int $maximumMessageCount) : array;
}