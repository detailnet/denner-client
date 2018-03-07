<?php

namespace Denner\Client;

use ReflectionClass;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface as HttpClientInterface;
use GuzzleHttp\Command\Guzzle\Description as ServiceDescription;
use GuzzleHttp\Command\Guzzle\DescriptionInterface as ServiceDescriptionInterface;
use GuzzleHttp\Command\Guzzle\GuzzleClient as ServiceClient;

use Denner\Client\Exception;
use Denner\Client\Response;
use Denner\Client\Subscriber;

/**
 * Magento 2 API client.
 *
 * @method Response\ResourceResponse integrationAdminToken(array $params = array())
 * @method Response\ResourceResponse listProducts(array $params = array())
 */
class MagentoClient extends ServiceClient
{
    const CLIENT_VERSION = '1.0.0';

    const OPTION_USERNAME = 'username';
    const OPTION_PASSWORD = 'password';
//    const OPTION_TOKEN = 'token';
//
//    const HEADER_AUTHORIZATION  = 'Authorization';
//
//    /**
//     * @var string
//     */
//    private $token;

    /**
     * @param array $options
     * @return static
     */
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
            // We are forced to use XML instead of JSON for the moment because 'integrationAdminToken'
            // does returns a plain string instead of structured JSON.
            // With XML 'integrationAdminToken' operation return at least an XML that can be parsed as such.
            // For all other operations both JSON or XML work correctly.
            //'Accept' => 'application/json',
            'Accept' => 'application/xml',
            'User-Agent' => 'denner-client/' . self::CLIENT_VERSION,
        );

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
        $httpClient->getEmitter()->attach(new Subscriber\Http\ProcessError());

        $serviceDescriptionFile = __DIR__ . sprintf('/ServiceDescription/%s.php', self::getServiceDescriptionName());

        if (!file_exists($serviceDescriptionFile)) {
            throw new Exception\RuntimeException(
                sprintf('Service description does not exist at "%s"', $serviceDescriptionFile)
            );
        }

        $description = new ServiceDescription(require $serviceDescriptionFile);
        $client = new static(
            $httpClient,
            $description
//            ,$options[self::OPTION_USERNAME] ?: null
//            ,$options[self::OPTION_PASSWORD] ?: null
        );

        return $client;
    }

    /**
     * @param HttpClientInterface $client
     * @param ServiceDescriptionInterface $description
//     * @param string|null $username
//     * @param string|null $password
     */
    public function __construct(
        HttpClientInterface $client,
        ServiceDescriptionInterface $description
//        ,$username = null
//        ,$password = null
    ) {
        $config = array(
            'process' => false, // Don't use Guzzle Service's processing (we're rolling our own...)
        );

        parent::__construct($client, $description, $config);

        $emitter = $this->getEmitter();
        $emitter->attach(new Subscriber\Command\PrepareRequest($description));
        $emitter->attach(new Subscriber\Command\ProcessResponse($description));

//        // If username and password provided, then get auth token
//        if ($username !== null && $password !== null) {
//            $authResponse = $this->integrationAdminToken(
//                array(
//                    'username' => $username,
//                    'password' => $password,
//                )
//            );
//
//            $this->token = $authResponse->getResource()->get(0);
              // Add client header [HEADER_AUTHORIZATION] = "Bearer <token>"
//        }
    }

    /**
     * @return string
     */
    public function getServiceUrl()
    {
        return $this->getHttpClient()->getBaseUrl();
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

    /**
     * @param string $method
     * @param array $args
     * @return mixed
     */
    public function __call($method, array $args)
    {
        // It seems we can't intercept Guzzle's request exceptions through the event system...
        // e.g. when the endpoint is unreachable or the request times out.
        try {
            return parent::__call($method, $args);
        } catch (\Exception $e) {
            throw Exception\OperationException::wrapException($e);
        }
    }

    /**
     * @param string $option
     * @return string|null
     */
    protected function getHeaderOption($option)
    {
        $headers = $this->getHttpClient()->getDefaultOption('headers');

        return array_key_exists($option, $headers) ? $headers[$option] : null;
    }
}
