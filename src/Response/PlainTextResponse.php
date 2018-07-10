<?php

namespace Denner\Client\Response;

use GuzzleHttp\Command\Guzzle\Operation;
use GuzzleHttp\Psr7\Response as PsrResponse;

class PlainTextResponse extends ResourceResponse
{
    /**
     * @return array
     */
    protected function extractData()
    {
        return [
            'response' => substr($this->getHttpResponse()->getBody()->getContents(), 1, -1),
        ];
    }
}
