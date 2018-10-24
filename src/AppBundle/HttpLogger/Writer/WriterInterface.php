<?php

namespace AppBundle\HttpLogger\Writer;


use AppBundle\Entity\HttpLog;

interface WriterInterface
{
    public function write(HttpLog $httpLog);
}