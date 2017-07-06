<?php

namespace Microservice\CoreBundle\Interfaces;

interface ProcessorInterface {
    public function process(QueueMessageInterface $message) : void;
}