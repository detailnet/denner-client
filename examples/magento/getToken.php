<?php

use Denner\Client\MagentoClient;

$config = require realpath(__DIR__ . '/../bootstrap.php');
$params = array(
);

$client = MagentoClient::factory($config);

$response = $client->integrationAdminToken(
    array(
        'username' => $config[MagentoClient::OPTION_USERNAME],
        'password' => $config[MagentoClient::OPTION_PASSWORD],
    )
);

$token = $response->getResource()->get(0);

var_dump('Token:', $token);

$url = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']);

$operations = array(
    'listProducts',
);

foreach ($operations as $operation) {
    printf('<br/><a target="_blank" href="%1$s/%2$s.php?token=%3$s">%2$s</a>', $url, $operation, $token);
}
