<?php


namespace AppBundle\HttpLogger\Writer;

use AppBundle\Entity\HttpLog;

class StdoutWriter implements WriterInterface
{
    public function write(HttpLog $httpLog)
    {
        $message = "[{$httpLog->getRequest()->getDate()->format('Y-m-d')} {$httpLog->getRequest()->getTime()->format('H:i:s')}] ";
        $message .= "{$httpLog->getRequest()->getClientIp()} ";
        $message .= "[{$httpLog->getResponse()->getHttpStatus()}]: {$httpLog->getRequest()->getUrl()}\n";

        file_put_contents('php://stdout', $message);
    }
}