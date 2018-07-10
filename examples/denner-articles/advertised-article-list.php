<?php

use Denner\Client\ArticlesClient;

$config = require realpath(__DIR__ . '/../bootstrap.php');
$params = [];

// Example: ?page=2
if (isset($_GET['page'])) {
    $params['page'] = (int) $_GET['page'];
}

// Example: &page_size=20
if (isset($_GET['page_size'])) {
    $params['page_size'] = (int) $_GET['page_size'];
}

$params['filter'] = [
    [
        'property' => 'year',
        'value' => '2015',
        'operator' => '=', // equals
        'type' => 'string',
    ],
    [
        'property' => 'week',
        'value' => '50',
        'operator' => '=', // equals
        'type' => 'string',
    ],
];

$params['sort'] = [
    [
        'property' => 'article_id',
        'direction' => 'desc',
    ],
];

$client = ArticlesClient::factory($config);

$response = $client->listAdvertisedArticles($params);

var_dump($response);
