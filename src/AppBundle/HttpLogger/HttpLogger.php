<?php

namespace AppBundle\HttpLogger;

use AppBundle\Entity\HttpLog;
use AppBundle\HttpLogger\Writer\WriterInterface;

class HttpLogger
{
    private $writer;
    private $httpLog;

    public function __construct(HttpLog $httpLog, WriterInterface $writer)
    {
        $this->writer = $writer;
        $this->httpLog = $httpLog;
    }

    public function log()
    {
        $this->writer->write($this->httpLog);
    }
}