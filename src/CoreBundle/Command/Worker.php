<?php

namespace Microservice\CoreBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Microservice\CoreBundle\Interfaces\ProcessorErrorHandlerInterface;
use Microservice\CoreBundle\Interfaces\ProcessorInterface;
use Microservice\CoreBundle\Interfaces\QueueDriverInterface;
use Microservice\CoreBundle\Message\QueueMessage;

class Worker extends Command {
    const COMMAND_NAME = 'ms:worker';

    /**
     * @var ProcessorInterface
     */
    protected $processor;

    /**
     * @var QueueDriverInterface
     */
    protected $queueDriver;

    /**
     * @var ProcessorErrorHandlerInterface
     */
    protected $errorHandler;

    /**
     * @var int
     */
    protected $maximumMessageCount;

    /**
     * @var int
     */
    protected $maximumMessageRead;

    public function __construct(
        ProcessorInterface $processor,
        QueueDriverInterface $queueDriver,
        ProcessorErrorHandlerInterface $errorHandler,
        int $maximumMessageCount,
        int $maximumMessageRead
    ) {
        parent::__construct();
        $this->processor = $processor;
        $this->queueDriver = $queueDriver;
        $this->errorHandler = $errorHandler;
        $this->maximumMessageCount = $maximumMessageCount;
        $this->maximumMessageRead = $maximumMessageRead;
    }

    protected function configure() {
        $this->setName(self::COMMAND_NAME);
        $this->setDescription('The main worker process');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $counter = 0;
        while(true) {
            $messages = $this->queueDriver->getMessages($this->maximumMessageRead);
            if($messages == []) {
                sleep(1);
                continue;
            }
            $this->processMessages($messages);
            $counter += count($messages);
            if($counter >= $this->maximumMessageCount) {
                $this->workerExit();
            }
        }
    }

    /**
     * @param QueueMessage[] $messages
     */
    protected function processMessages(array $messages) : void {
        foreach ($messages as $message) {
            $this->processMessage($message);
        }
    }

    /**
     * @param QueueMessage $message
     */
    protected function processMessage(QueueMessage $message): void {
        try {
            $this->processor->process($message);
        } catch(\Exception $e) {
            $this->errorHandler->onError($message, $e);
        }
    }

    protected function workerExit() {
        exit(0);
    }
}