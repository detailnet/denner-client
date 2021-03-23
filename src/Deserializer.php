<?php

namespace Denner\Client;

use Denner\Client\Response\Response;
use GuzzleHttp\Command\CommandInterface;
use GuzzleHttp\Command\Guzzle\DescriptionInterface as ServiceDescription;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request as PsrRequest;
use GuzzleHttp\Psr7\Response as PsrResponse;

class Deserializer
{
    protected ServiceDescription $description;

    public function __construct(ServiceDescription $description)
    {
        $this->description = $description;
    }

    public function __invoke(PsrResponse $response, PsrRequest $request, CommandInterface $command): ?Response
    {
        $name = $command->getName();
        $operation = $this->description->getOperation($name);

        // No exception for Not Found errors
        if ($response->getStatusCode() == 404
            && $operation->getData('throw_exception_when_not_found') === false
        ) {
            return null;
        } elseif ($response->getStatusCode() >= 400) {
            throw RequestException::create($request, $response);
        }

        $responseClass = $operation->getResponseModel();

        //if ($responseClass === null) {
        //    throw new Exception\RuntimeException(
        //        sprintf('No response class configured for operation "%s"', $command->getName())
        //    );
        //}

        if (!class_exists($responseClass)) {
            throw new Exception\RuntimeException(
                sprintf(
                    'Response class "%s" of operation "%s" does not exist',
                    $responseClass,
                    $command->getName()
                )
            );
        }

        /** @todo We could check if the response class implements ResponseInterface */

        /** @var Response $responseClass */

        return $responseClass::fromOperation($operation, $response);
    }
}
