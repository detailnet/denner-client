<?php

namespace Denner\Client;

use ReflectionClass;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface as HttpClientInterface;
use GuzzleHttp\Collection;
use GuzzleHttp\Command\Guzzle\Description as ServiceDescription;
use GuzzleHttp\Command\Guzzle\DescriptionInterface as ServiceDescriptionInterface;
use GuzzleHttp\Command\Guzzle\GuzzleClient as ServiceClient;

use Denner\Client\Subscriber;

abstract class DennerClient extends ServiceClient
{
    const CLIENT_VERSION = '1.0.0';

    public static function factory($options = array())
    {
//        $requiredOptions = array();
//
//        foreach ($requiredOptions as $optionName) {
//            if (!isset($options[$optionName]) || $options[$optionName] === '') {
//                throw new Exception\InvalidArgumentException(
//                    sprintf('Missing required configuration option "%s"', $optionName)
//                );
//            }
//        }

        // These are applied if not otherwise specified
        $defaultOptions = array(
            'base_url' => self::getDefaultServiceUrl(),
            'defaults' => array(
                // Float describing the number of seconds to wait while trying to connect to a server.
                // 0 was the default (wait indefinitely).
                'connect_timeout' => 10,
                // Float describing the timeout of the request in seconds.
                // 0 was the default (wait indefinitely).
                'timeout' => 60, // 60 seconds, may be overridden by individual operations
            ),
        );

        $headers = array(
            'Accept' => 'application/json',
            'User-Agent' => 'denner-client/' . self::CLIENT_VERSION,
        );

        if (isset($options['app_id'])) {
            $headers['App-ID'] = $options['app_id'];
        }

        if (isset($options['app_key'])) {
            $headers['App-Key'] = $options['app_key'];
        }

        // These are always applied
        $overrideOptions = array(
            'defaults' => array(
                // We're using our own error handler
                // (this disables the use of the internal HttpError subscriber)
                'exceptions' => false,
                'headers' => $headers,
            ),
        );

        // Apply options
        $config = array_replace_recursive($defaultOptions, $options, $overrideOptions);

        $httpClient = new HttpClient($config);
        $httpClient->getEmitter()->attach(new Subscriber\ErrorHandler());

        $serviceDescriptionFile = __DIR__ . sprintf('/ServiceDescription/%s.php', self::getServiceDescriptionName());

        if (!file_exists($serviceDescriptionFile)) {
            throw new Exception\RuntimeException(
                sprintf('Service description does not exist at "%s"', $serviceDescriptionFile)
            );
        }

        $description = new ServiceDescription(require $serviceDescriptionFile);
        $client = new static($httpClient, $description);

        return $client;
    }

    /**
     * @param HttpClientInterface $client
     * @param ServiceDescriptionInterface $description
     */
    public function __construct(
        HttpClientInterface $client,
        ServiceDescriptionInterface $description
    ) {
        $config = array(
            'process' => false, // Don't use Guzzle Service's processing (we're rolling our own...)
        );

        parent::__construct($client, $description, $config);

        $emitter = $this->getEmitter();
        $emitter->attach(
            new Subscriber\ProcessResponse($description)
        );
    }

    /**
     * @return string
     */
    protected static function getDefaultServiceUrl()
    {
        $versionParts = explode('.', self::CLIENT_VERSION);

        return sprintf('https://denner-api.detailnet.ch/v%s/', reset($versionParts));
    }

    /**
     * @param boolean $asSnake
     * @return string
     */
    protected static function getServiceName($asSnake = true)
    {
        $className = (new ReflectionClass(static::CLASS))->getShortName();
        $serviceName = str_replace('Client', '', $className);

        if ($asSnake !== false) {
            $serviceName = ltrim(strtolower(preg_replace('/[A-Z]/', '-$0', $serviceName)), '-');
            $serviceName = preg_replace('/[-]+/', '-', $serviceName);
        }

        return $serviceName;
    }

    /**
     * @return string
     */
    protected static function getServiceDescriptionName()
    {
        return self::getServiceName(false);
    }

    /**
     * @param array $filtersToAdd
     * @param array $params
     */
    protected function addOrReplaceFilters(array $filtersToAdd, array &$params)
    {
        // We may need to replace already existing filters
        if (isset($params['filter']) && is_array($params['filter'])) {
            $filters = array();

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
}
