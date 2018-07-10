<?php

namespace Denner\Client\Response;

use GuzzleHttp\Command\Event\ProcessEvent;
use GuzzleHttp\Command\Guzzle\Operation;
use GuzzleHttp\Message\ResponseInterface as HttpResponseInterface;

class PlainTextResponse extends BaseResponse
{
    /**
     * @param Operation $operation
     * @param ProcessEvent $event
     * @return ResponseInterface
     */
    public static function fromOperation(Operation $operation, ProcessEvent $event)
    {
        return new static($event->getResponse());
    }

    /**
     * @param HttpResponseInterface $response
     */
    public function __construct(HttpResponseInterface $response)
    {
        parent::__construct($response);
    }

    /**
     * @return \Denner\Client\Response\Resource
     */
    public function getResource()
    {
        return new Resource($this->getData());
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->getData();
    }

    /**
     * @return array
     */
    protected function getData()
    {
        return [
            'response' => substr($this->getHttpResponse()->getBody()->getContents(), 1, -1),
        ];
    }
}
