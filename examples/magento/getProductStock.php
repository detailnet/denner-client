<?php

use Denner\Client\MagentoClient;

$config = require realpath(__DIR__ . '/../bootstrap.php');
$params = array(
);

$client = MagentoClient::factory($config);

$token = @$_GET['token'] ?: 'ajs8vvnm0vgk976iiqv6optdsjucp05r';
$id = @$_GET['id'] ?: '050005';

if (!$token) {
    throw new RuntimeException('Missing or invalid parameter "token"');
}

$response = $client->getProductStock(
    array(
        'Authorization' => sprintf('Bearer %s', $token),
        'productSku' => $id,
    )
);


var_dump($response->getResource());
//echo '<pre>'; print_r($response->getResource()->get('items'));
