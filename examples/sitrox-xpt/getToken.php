<?php

use Denner\Client\SitroxXptClient;

$config = require realpath(__DIR__ . '/../bootstrap.php');

$client = SitroxXptClient::factory($config);

// The token is automatically fetched on factory, output it
var_dump($client->getAuthorizationString());
