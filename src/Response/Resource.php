<?php

namespace Denner\Client\Response;

use ArrayAccess;
use Denner\Client\Exception;
use JmesPath\Env as JmesPath;
use function assert;
use function is_string;

class Resource implements
    ArrayAccess
{
    public function __construct(
        protected array $data = []
    ) { }

    public function has(string $key): bool
    {
        return $this->get($key) !== null;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->data[$key] ?? $default;
    }

    public function search(string $expression): mixed
    {
        return JmesPath::search($expression, $this->data);
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function __toString(): string
    {
        $jsonData = json_encode($this->data, JSON_PRETTY_PRINT);

        return <<<EOT
Model Data
----------
Data can be retrieved from the model object using the get() method of the
model (e.g., `\$resource->get(\$key)`) or "accessing the result like an
associative array (e.g. `\$resource['key']`). You can also execute JMESPath
expressions on the result data using the search() method.

{$jsonData}

EOT;
    }

    public function offsetGet(mixed $offset): mixed
    {
        assert(is_string($offset));

        return $this->get($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        assert(is_string($offset));

        throw new Exception\RuntimeException(
            sprintf('Resource is read-only; cannot set "%s"', $offset)
        );
    }

    public function offsetExists(mixed $offset): bool
    {
        assert(is_string($offset));

        return $this->has($offset);
    }

    public function offsetUnset(mixed $offset): void
    {
        assert(is_string($offset));

        throw new Exception\RuntimeException(
            sprintf('Resource is read-only; cannot unset "%s"', $offset)
        );
    }
}
