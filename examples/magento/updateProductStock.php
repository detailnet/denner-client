<?php

use Denner\Client\MagentoClient;

$config = require realpath(__DIR__ . '/../bootstrap.php');

$client = MagentoClient::factory($config);

$token = @$_GET['token'] ?: false;
$id = @$_GET['id'] ?: false;
$pid = @$_GET['pid'] ?: false;
$stock = @$_GET['stock'] ?: false;

if (!$token) {
    throw new RuntimeException('Missing or invalid parameter "token"');
}

if (!$id) {
    throw new RuntimeException('Missing or invalid parameter "id"');
}

if (!$pid) {
    throw new RuntimeException('Missing or invalid parameter "pid"');
}

if (!$stock) {
    throw new RuntimeException('Missing or invalid parameter "stock"');
}

$response = $client->updateProductStock(
    array(
        'Authorization' => sprintf('Bearer %s', $token),
        'productSku' => $id,
        'itemId' => $pid, // Tests have demonstrated that this param has no effect on the result, is ignored but has to be present
        'stockItem' => array(
            "qty" => (int) $stock,
            "is_in_stock" => ((int) $stock) > 0,
        ),
    )
);

var_dump($response->toArray());
