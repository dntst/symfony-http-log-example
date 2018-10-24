<?php

namespace AppBundle\HttpLogger;

use AppBundle\Entity\HttpHeader;
use AppBundle\Entity\HttpLog;
use AppBundle\Entity\HttpRequestItem;
use AppBundle\Entity\HttpResponseItem;
use AppBundle\HttpLogger\Writer\WriterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HttpLogger
{
    private $request;
    private $response;
    private $writer;
    private $httpLog;

    public function __construct(Request $request, Response $response, WriterInterface $writer)
    {
        $this->request = $request;
        $this->response = $response;
        $this->writer = $writer;

        $this->prepareHttpLog();
    }

    private function prepareHttpLog()
    {
        $httpRequestItem = new HttpRequestItem();
        $httpRequestItem->setUrl($this->request->getUri());
        $httpRequestItem->setBody($this->request->getContent());
        $httpRequestItem->setClientIp($this->request->getClientIp());
        $httpRequestItem->setDate(new \DateTime());
        $httpRequestItem->setTime(new \DateTime());

        foreach ($this->request->headers->all() as $key => $value) {
            $httpHeader = new HttpHeader();
            $httpHeader->setName($key);
            $httpHeader->setValue($value[0]);
            $httpHeader->setRequest($httpRequestItem);
            $httpRequestItem->addHeader($httpHeader);
        }

        $httpResponseItem = new HttpResponseItem();
        $httpResponseItem->setBody($this->response->getContent());
        $httpResponseItem->setHttpStatus($this->response->getStatusCode());

        foreach ($this->response->headers->all() as $key => $value) {
            $httpHeader = new HttpHeader();
            $httpHeader->setName($key);
            $httpHeader->setValue($value[0]);
            $httpHeader->setResponse($httpResponseItem);
            $httpResponseItem->addHeader($httpHeader);
        }

        $this->httpLog = new HttpLog();
        $this->httpLog->setRequest($httpRequestItem);
        $this->httpLog->setResponse($httpResponseItem);
    }

    public function log()
    {
        $this->writer->write($this->httpLog);
    }
}