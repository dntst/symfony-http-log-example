<?php

namespace AppBundle\EventListener;

use AppBundle\HttpLogger\HttpLogBuilder;
use AppBundle\HttpLogger\HttpLogger;
use AppBundle\HttpLogger\Writer\DoctrineWriter;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Event\PostResponseEvent;

class KernelListener
{
    private $em;
    private $logger;

    public function __construct(EntityManagerInterface $em, LoggerInterface $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
    }

    public function onKernelTerminate(PostResponseEvent $event)
    {
        if (!$event->getRequest()->query->has('log_me') && !$event->getRequest()->request->has('log_me')) {
            return;
        }

        $httpLogBuilder = new HttpLogBuilder($event->getRequest(), $event->getResponse());
        $httpLog = $httpLogBuilder->build();

        $writer = new DoctrineWriter($this->em, $this->logger);
        $httpLogger = new HttpLogger($httpLog, $writer);
        $httpLogger->log();
    }
}