<?php

namespace AppBundle\HttpLogger;

use AppBundle\Entity\HttpHeader;
use AppBundle\Entity\HttpLog;
use AppBundle\Entity\HttpRequestItem;
use AppBundle\Entity\HttpResponseItem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HttpLogBuilder
{
    private $request;
    private $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /*
     * @return HttpLog
     */
    public function build()
    {
        $httpRequestItem = new HttpRequestItem();
        $httpRequestItem->setUrl($this->request->getUri());
        $httpRequestItem->setBody($this->request->getContent());
        $httpRequestItem->setClientIp($this->request->getClientIp());
        $httpRequestItem->setDate(new \DateTime());
        $httpRequestItem->setTime(new \DateTime());
        $httpRequestItem->setMethod($this->request->getMethod());

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

        $httpLog = new HttpLog();
        $httpLog->setRequest($httpRequestItem);
        $httpLog->setResponse($httpResponseItem);

        return $httpLog;
    }
}