<?php

namespace Denner\Client\Response;

use Denner\Client\Exception;
use GuzzleHttp\Psr7\Response as PsrResponse;
use Throwable;
use function json_decode;
use function sprintf;

abstract class BaseResponse implements
    Response
{
    protected array $data = [];

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected PsrResponse $response,
        private array $options = []
    ) {
        $this->data = $this->extractData();
    }

    public function getHttpResponse(): PsrResponse
    {
        return $this->response;
    }

    public function getOption(string $key, mixed $defaultValue = null): mixed
    {
        return $this->options[$key] ?? $defaultValue;
    }

    public function toArray(): array
    {
        return $this->getData();
    }

    protected function getData(): array
    {
        return $this->data;
    }

    protected function extractData(): array
    {
        try {
            return $this->decodeJson($this->getHttpResponse()->getBody());
        } catch (Throwable $e) {
            throw new Exception\RuntimeException(
                sprintf('Failed extract JSON data from HTTP response: %s', $e->getMessage()),
                $e->getCode(),
                $e
            );
        }
    }

    private function decodeJson(string $value): array
    {
        return json_decode($value, true, 512, JSON_THROW_ON_ERROR); // @phpstan-ignore-line With associative:true ant throw-errors option, an array is always returned
    }
}
