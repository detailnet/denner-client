<?php

use Denner\Client\SitroxXptClient;

$config = require realpath(__DIR__ . '/../bootstrap.php');

$client = SitroxXptClient::factory($config);

$response = $client->getMagazine(
    [
        'Authorization' => $client->getAuthorizationString(),
        'year_week' => 202343,
    ]
);

echo "<pre>";
print_r($response->getResource());
