<?php

namespace Microservice\CoreBundle\Interfaces;

interface QueueMessageInterface {
    public function getMessageText() : string;
}