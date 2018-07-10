<?php

namespace Denner\Client\Response;

use GuzzleHttp\Command\Guzzle\Operation;
use GuzzleHttp\Psr7\Response as PsrResponse;

use Denner\Client\Response\Resource as ClientResource;

class ResourceResponse extends BaseResponse
{
    /**
     * @var ClientResource
     */
    protected $resource;

    /**
     * @param Operation $operation
     * @param PsrResponse $response
     * @return ResourceResponse
     */
    public static function fromOperation(Operation $operation, PsrResponse $response): Response
    {
        return new static($response);
    }

    public function getResource(): ClientResource
    {
        if ($this->resource === null) {
            $this->resource = new ClientResource($this->getData());
        }

        return $this->resource;
    }
}
