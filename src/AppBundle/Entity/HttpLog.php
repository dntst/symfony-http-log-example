<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HttpLog
 *
 * @ORM\Table(name="http_logs")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HttpLogRepository")
 */
class HttpLog
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @var HttpRequestItem
     *
     * @ORM\OneToOne(targetEntity="HttpRequestItem", inversedBy="httpLog", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="http_request_item_id", referencedColumnName="id")
     */
    private $request;

    /**
     * @var HttpResponseItem
     *
     * @ORM\OneToOne(targetEntity="HttpResponseItem", inversedBy="httpLog", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="http_response_item_id", referencedColumnName="id")
     */
    private $response;

    /**
     * Set request
     *
     * @param HttpRequestItem $request
     *
     * @return HttpLog
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
     * @return HttpLog
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

