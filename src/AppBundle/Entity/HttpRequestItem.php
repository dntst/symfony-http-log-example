<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * HttpRequestItem
 *
 * @ORM\Table(name="http_request_items")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HttpLogRepository")
 */
class HttpRequestItem
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
     * @ORM\Column(name="url", type="string", length=2048)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="client_ip", type="string", length=15)
     */
    private $clientIp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="time")
     */
    private $time;

    /**
     * @var HttpLog
     *
     * @ORM\OneToOne(targetEntity="HttpLog", mappedBy="request")
     */
    private $httpLog;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="HttpHeader", mappedBy="request", cascade={"persist", "remove"})
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
     * Set url
     *
     * @param string $url
     *
     * @return HttpRequestItem
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return HttpRequestItem
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
     * Set clientIp
     *
     * @param string $clientIp
     *
     * @return HttpRequestItem
     */
    public function setClientIp($clientIp)
    {
        $this->clientIp = $clientIp;

        return $this;
    }

    /**
     * Get clientIp
     *
     * @return string
     */
    public function getClientIp()
    {
        return $this->clientIp;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return HttpRequestItem
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return HttpRequestItem
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set httpLog
     *
     * @param HttpLog $httpLog
     *
     * @return HttpRequestItem
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
     * @return HttpRequestItem
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
     * @return HttpRequestItem
     */
    public function removeHeader($httpHeader)
    {
        $this->headers->removeElement($httpHeader);

        return $this;
    }
}

