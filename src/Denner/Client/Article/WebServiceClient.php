<?php
namespace Denner\Client\Article;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Collection;
use GuzzleHttp\Command\Guzzle\Description as ServiceDescription;
use GuzzleHttp\Command\Guzzle\GuzzleClient as ServiceClient;

use Denner\Client\Article\Subscriber;
/**
 * Created by PhpStorm.
 * User: Mirko
 * Date: 20.10.2015
 * Time: 11:20
 */


class WebServiceClient  extends ServiceClient{
    public static function factory($options = array())
    {
        $defaultOptions = array(
            'base_url' => 'https://denner-articles.detailnet.ch/api/articles',
            'defaults' => array(
                // We're using our own error handler
                // (this disabled the use of the internal HttpError subscriber)
                'exceptions' => false,
                // Float describing the number of seconds to wait while trying to connect to a server.
                // 0 was the default (wait indefinitely).
                'connect_timeout' => 10,
                // Float describing the timeout of the request in seconds.
                // 0 was the default (wait indefinitely).
                'timeout' => 60, // 60 seconds, may be overridden by individual operations
            ),
        );

        $config = Collection::fromConfig($options, $defaultOptions);

        $headers = array(
            'Accept' => 'application/json'
        );

        if (isset($options['app_id'])) {
            $headers['App-ID'] = $options['app_id'];
        }

        if (isset($options['app_key'])) {
            $headers['App-Key'] = $options['app_key'];
        }

        $httpClient = new HttpClient($config->toArray());
        $httpClient->setDefaultOption('headers', $headers);
        $httpClient->getEmitter()->attach(new Subscriber\ErrorHandler());

        $description = new ServiceDescription(
            require __DIR__ . '/ServiceDescription/AricleService.php'
        );

        $client = new self($httpClient, $description);

        return $client;
    }


}