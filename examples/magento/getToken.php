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


$i = 0;
$token = '';

// Result is a plain string, not JSON as should be.
// Can't get resource (results in error for the malformed body), but can get each byte of the body
while (($c = $response->offsetGet($i++)) !== null) {
   $token .= $c;
}

var_dump('Token:', $token);

$url = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']);

$operations = array(
    'listProducts'    => sprintf('?token=%s', $token),
    'getProductStock' => sprintf('?token=%s&id=%s', $token , '050005'),
    'listOrders'      => sprintf('?token=%s&from=%s', $token, urlencode('2018-01-01 00:00:00')),
);

foreach ($operations as $operation => $params) {
    printf('<br/><a target="_blank" href="%1$s/%2$s.php%3$s">%2$s</a>', $url, $operation, $params);
}
