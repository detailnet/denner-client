<?php

use Denner\Client\SitroxXptClient;

$config = require realpath(__DIR__ . '/../bootstrap.php');

$client = SitroxXptClient::factory($config);

$response = $client->getMagazine(
    [
        'Authorization' => $client->getAuthorizationString(),
        'year_week' => @$_GET['year_week'] ?: 202430,
    ]
);

echo "<pre>";
print_r($response->getResource());
