<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HttpHeader
 *
 * @ORM\Table(name="http_headers")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HttpLogRepository")
 */
class HttpHeader
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;

    /**
     * @var HttpRequestItem
     *
     * @ORM\ManyToOne(targetEntity="httpRequestItem", inversedBy="headers", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="http_request_id", referencedColumnName="id")
     */
    private $request;

    /**
     * @var HttpResponseItem
     *
     * @ORM\ManyToOne(targetEntity="httpResponseItem", inversedBy="headers", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="http_response_id", referencedColumnName="id")
     */
    private $response;

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
     * Set name
     *
     * @param string $name
     *
     * @return HttpHeader
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return HttpHeader
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set request
     *
     * @param HttpRequestItem $request
     *
     * @return HttpHeader
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Get request
     *
     * @return HttpRequestItem
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set response
     *
     * @param HttpResponseItem $response
     *
     * @return HttpHeader
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Get response
     *
     * @return HttpResponseItem
     */
    public function getResponse()
    {
        return $this->response;
    }
}

