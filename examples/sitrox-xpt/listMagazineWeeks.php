<?php

use Denner\Client\SitroxXptClient;

$config = require realpath(__DIR__ . '/../bootstrap.php');

$client = SitroxXptClient::factory($config);

$response = $client->listMagazineWeeks(
    [
        'Authorization' => $client->getAuthorizationString(),
        'year' => @$_GET['year'] ?: (new DateTime())->format('Y'),
    ]
);

echo "<pre>";
print_r($response->getResource());
