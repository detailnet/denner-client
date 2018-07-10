<?php

use Denner\Client\MagentoClient;

$config = require realpath(__DIR__ . '/../bootstrap.php');
$client = MagentoClient::factory($config);

$token = @$_GET['token'] ?: false;
$id = @$_GET['id'] ?: false;

if (!$token) {
    throw new RuntimeException('Missing or invalid parameter "token"');
}

if (!$id) {
    throw new RuntimeException('Missing or invalid parameter "id"');
}

$response = $client->getProductStock(
    [
        'Authorization' => sprintf('Bearer %s', $token),
        'productSku' => $id,
    ]
);

var_dump($response->getResource());
//echo '<pre>'; print_r($response->getResource()->get('items'));
