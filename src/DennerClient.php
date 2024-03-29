<?php

namespace Denner\Client;

use Denner\Client\Exception;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Command\Guzzle\Description as ServiceDescription;
use GuzzleHttp\Command\Guzzle\GuzzleClient as ServiceClient;
use ReflectionClass;
use function array_replace_recursive;
use function array_values;
use function assert;
use function is_array;
use function ltrim;
use function preg_replace;
use function sprintf;
use function str_replace;
use function strtolower;

abstract class DennerClient extends ServiceClient implements
    Client
{
    const CLIENT_VERSION = '5.0.0';

    const OPTION_BASE_URI = 'base_uri';
    const OPTION_APP_ID = 'app_id';
    const OPTION_APP_KEY = 'app_key';

    const HEADER_APP_ID = 'App-ID';
    const HEADER_APP_KEY = 'App-Key';

    private string $serviceUrl;
    private ?string $serviceAppId;
    private ?string $serviceAppKey;

    public static function factory(array $options = []): DennerClient
    {
//        $requiredOptions = [];
//
//        foreach ($requiredOptions as $optionName) {
//            if (!isset($options[$optionName]) || $options[$optionName] === '') {
//                throw new Exception\InvalidArgumentException(
//                    sprintf('Missing required configuration option "%s"', $optionName)
//                );
//            }
//        }

        // These are applied if not otherwise specified
        $defaultOptions = [
            'base_uri' => self::getDefaultServiceUrl(),
            // Float describing the number of seconds to wait while trying to connect to a server.
            // 0 was the default (wait indefinitely).
            'connect_timeout' => 10,
            // Float describing the timeout of the request in seconds.
            // 0 was the default (wait indefinitely).
            'timeout' => 60,
        ];

        $headers = [
            'Accept' => 'application/json',
            'User-Agent' => 'denner-client/' . self::CLIENT_VERSION,
        ];

        if (isset($options[self::OPTION_APP_ID])) {
            $headers[self::HEADER_APP_ID] = $options[self::OPTION_APP_ID];
        }

        if (isset($options[self::OPTION_APP_KEY])) {
            $headers[self::HEADER_APP_KEY] = $options[self::OPTION_APP_KEY];
        }

        // These are always applied
        $overrideOptions = [
            // We're using our own error handling middleware,
            // so disable throwing exceptions on HTTP protocol errors (i.e., 4xx and 5xx responses).
            'http_errors' => false,
            'headers' => $headers,
        ];

        // Apply options
        $config = array_replace_recursive($defaultOptions, $options, $overrideOptions);

        $httpClient = new HttpClient($config);
//        $httpClient->getEmitter()->attach(new Subscriber\Http\ProcessError());

        $serviceDescriptionFile = __DIR__ . sprintf('/ServiceDescription/%s.php', self::getServiceDescriptionName());

        if (!file_exists($serviceDescriptionFile)) {
            throw new Exception\RuntimeException(
                sprintf('Service description does not exist at "%s"', $serviceDescriptionFile)
            );
        }

        $description = new ServiceDescription(require $serviceDescriptionFile);
        $deserializer = new Deserializer($description);

        $client = new static($httpClient, $description, null, $deserializer);
        $client->serviceUrl = $config['base_uri'] ?? $defaultOptions['base_uri'];
        $client->serviceAppId = $config['headers'][self::HEADER_APP_ID] ?? null;
        $client->serviceAppKey = $config['headers'][self::HEADER_APP_KEY] ?? null;

        return $client;
    }

    public function getServiceAppId(): ?string
    {
        return $this->serviceAppId;
    }

    public function getServiceAppKey(): ?string
    {
        return $this->serviceAppKey;
    }

    public function getServiceUrl(): string
    {
        assert(isset($this->serviceUrl));

        return $this->serviceUrl;
    }

    protected function addOrReplaceFilters(array $filtersToAdd, array &$params): void
    {
        // We may need to replace already existing filters
        if (isset($params['filter']) && is_array($params['filter'])) {
            $filters = [];

            foreach ($params['filter'] as $filter) {
                if (isset($filter['property']) && isset($filtersToAdd[$filter['property']])) {
                    $filters[] = $filtersToAdd[$filter['property']];
                    unset($filtersToAdd[$filter['property']]);
                } else {
                    $filters[] = $filter;
                }
            }

            // Append remaining filters
            $filters += $filtersToAdd;
        } else {
            $filters = array_values($filtersToAdd);
        }

        $params['filter'] = $filters;
    }

    private static function getDefaultServiceUrl(): string
    {
        $serviceName = self::getServiceName();

        return sprintf('https://denner-%s.detailnet.ch/api/', $serviceName);
    }

    private static function getServiceName(bool $asSnake = true): string
    {
        $className = (new ReflectionClass(static::class))->getShortName();
        $serviceName = str_replace('Client', '', $className);

        if ($asSnake !== false) {
            $serviceName = ltrim(strtolower(preg_replace('/[A-Z]/', '-$0', $serviceName) ?? ''), '-');
            $serviceName = preg_replace('/[-]+/', '-', $serviceName) ?? '';
        }

        return $serviceName;
    }

    private static function getServiceDescriptionName(): string
    {
        return self::getServiceName(false);
    }
}
