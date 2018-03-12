<?php

use Denner\Client\MagentoClient;

$config = require realpath(__DIR__ . '/../bootstrap.php');
$params = array(
);

$client = MagentoClient::factory($config);

$token = @$_GET['token'] ?: 'ajs8vvnm0vgk976iiqv6optdsjucp05r';
$id = @$_GET['id'] ?: '050005';
$pid = @$_GET['pid'] ?: '666';
$stock = (int) (@$_GET['stock'] ?: '123');

if (!$token) {
    throw new RuntimeException('Missing or invalid parameter "token"');
}

$response = $client->updateProductStock(
    array(
        'Authorization' => sprintf('Bearer %s', $token),
        'productSku' => $id,
        'itemId' => $pid, // Has no effect on the result, is ignored but has to be present
        'stockItem' => array(
            "qty" => $stock,
            "is_in_stock" => $stock > 0,
        ),
    )
);

var_dump($response->toArray());
//$i=0;
//$result = '';
//
//// Result is a plain string, not JSON as should be.
//// Can't get resource (results in error for the malformed body), but can get each byte of the body
//while (($c = $response->offsetGet($i++)) !== null) {
//    $result .= $c;
//}
//
//var_dump('Result:', $result);
