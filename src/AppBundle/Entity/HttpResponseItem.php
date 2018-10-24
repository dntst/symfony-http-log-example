<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * HttpResponseItem
 *
 * @ORM\Table(name="http_response_items")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HttpLogRepository")
 */
class HttpResponseItem
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var integer
     *
     * @ORM\Column(name="http_status", type="integer")
     */
    private $httpStatus;

    /**
     * @var HttpLog
     *
     * @ORM\OneToOne(targetEntity="HttpLog", mappedBy="response")
     */
    private $httpLog;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="HttpHeader", mappedBy="response", cascade={"persist", "remove"})
     */
    private $headers;

    public function __construct()
    {
        $this->headers = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return HttpResponseItem
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set http status
     *
     * @param integer $httpStatus
     *
     * @return HttpResponseItem
     */
    public function setHttpStatus($httpStatus)
    {
        $this->httpStatus = $httpStatus;

        return $this;
    }

    /**
     * Get http status
     *
     * @return integer
     */
    public function getHttpStatus()
    {
        return $this->httpStatus;
    }

    /**
     * Set httpLog
     *
     * @param HttpLog $httpLog
     *
     * @return HttpResponseItem
     */
    public function setHttpLog($httpLog)
    {
        $this->httpLog = $httpLog;

        return $this;
    }

    /**
     * Get httpLog
     *
     * @return HttpLog
     */
    public function getHttpLog()
    {
        return $this->httpLog;
    }

    /**
     * Get headers
     *
     * @return ArrayCollection
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Add header
     *
     * @param HttpHeader $httpHeader
     *
     * @return HttpResponseItem
     */
    public function addHeader($httpHeader)
    {
        $this->headers->add($httpHeader);

        return $this;
    }

    /**
     * Remove header
     *
     * @param HttpHeader $httpHeader
     *
     * @return HttpResponseItem
     */
    public function removeHeader($httpHeader)
    {
        $this->headers->removeElement($httpHeader);

        return $this;
    }
}

