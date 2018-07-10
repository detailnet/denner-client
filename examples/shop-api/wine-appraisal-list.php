<?php

use Denner\Client\ShopClient;

$config = require realpath(__DIR__ . '/../bootstrap.php');
$params = [];
$filterParams = [
    'id',
    'wine_id',
    'shop_user_id',
    'email',
    'source',
];

foreach ($filterParams as $param) {
    if (isset($_GET[$param])) {
        $params[$param] = $_GET[$param];
    }
}

// Example: ?page=2
if (isset($_GET['page'])) {
    $params['page'] = (int) $_GET['page'];
}

// Example: &page_size=20
if (isset($_GET['page_size'])) {
    $params['page_size'] = (int) $_GET['page_size'];
}

$params['sort'] = @$_GET['sort'] ?: 'created_on__asc';

$client = ShopClient::factory($config);

$response = $client->listWineAppraisals($params);

var_dump($response);
