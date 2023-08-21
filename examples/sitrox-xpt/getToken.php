<?php

use Denner\Client\SitroxXptClient;

$config = require realpath(__DIR__ . '/../bootstrap.php');

$client = SitroxXptClient::factory($config);

$response = $client->getToken([
    'Authorization' =>
        'Basic ' . base64_encode($config[SitroxXptClient::OPTION_CLIENT_ID] . ':' . $config[SitroxXptClient::OPTION_CLIENT_SECRET])
]);

echo "<pre>";
print_r($response->getResource());
