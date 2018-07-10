<?php

use Denner\Client\ShopClient;

$config = require realpath(__DIR__ . '/../bootstrap.php');

$wineId = @$_GET['wine_id'];
$appraisalId = @$_GET['appraisal_id'];
$type = @$_GET['type'] ?: 'up';

if (!$wineId) {
    throw new RuntimeException('Missing or invalid parameter "wine_id"');
}

if (!$appraisalId) {
    throw new RuntimeException('Missing or invalid parameter "appraisal_id"');
}

$params = [
    'wine_id' => $wineId,
    'appraisal_id' => $appraisalId,
    'type' => $type,
    'shop_user_id' => 123456789,
];

$client = ShopClient::factory($config);

$response = $client->createWineAppraisalVote($params);

var_dump($response);
