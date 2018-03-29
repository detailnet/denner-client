<?php

use Denner\Client\MagentoClient;

$config = require realpath(__DIR__ . '/../bootstrap.php');

$client = MagentoClient::factory($config);

$response = $client->getToken(
    array(
        'username' => $config['username'],
        'password' => $config['password'],
    )
);

$token = $response->getResource()->get('response');

var_dump('Token:', $token);

$url = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']);

$operations = array(
    'listProducts'       => sprintf('?token=%s', $token),
    'getProductStock'    => sprintf('?token=%s&id=%s', $token, '050005'),
    'updateProductStock' => sprintf('?token=%s&id=%s&pid=%s&stock=%s', $token, '050005', '666', '123'),
    'listOrders'         => sprintf('?token=%s&from=%s', $token, urlencode('2018-01-01 00:00:00')),
);

foreach ($operations as $operation => $params) {
    printf('<br/><a target="_blank" href="%1$s/%2$s.php%3$s">%2$s</a>', $url, $operation, $params);
}
