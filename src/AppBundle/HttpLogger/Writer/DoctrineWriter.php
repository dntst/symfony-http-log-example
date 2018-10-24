<?php

namespace AppBundle\HttpLogger\Writer;

use AppBundle\Entity\HttpLog;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class DoctrineWriter implements WriterInterface
{
    private $em;
    private $logger;

    public function __construct(EntityManagerInterface $em, LoggerInterface $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
    }

    public function write(HttpLog $httpLog)
    {
        try {
            $this->em->persist($httpLog);
            $this->em->flush();
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());
        }
    }
}