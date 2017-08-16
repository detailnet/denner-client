<?php

use Denner\Client\AdvertisingClient;

$config = require realpath(__DIR__ . '/../bootstrap.php');
$params = array();

$params['print_publication_id'] = @$_GET['print_publication_id'] ?: '44444444-aaaa-4444-aaaa-444444444444';

// Example: ?page=2
if (isset($_GET['page'])) {
    $params['page'] = (int) $_GET['page'];
}

// Example: &page_size=20
if (isset($_GET['page_size'])) {
    $params['page_size'] = (int) $_GET['page_size'];
}

//$params['filter'] = array(
//    array(
//        'property' => 'year',
//        'value' => '2015',
//        'operator' => '=', // equals
//        'type' => 'string',
//    ),
//    array(
//        'property' => 'week',
//        'value' => '50',
//        'operator' => '=', // equals
//        'type' => 'string',
//    ),
//);
//
//$params['sort'] = array(
//    array(
//        'property' => 'article_id',
//        'direction' => 'desc',
//    ),
//);

$client = AdvertisingClient::factory($config);

$response = $client->listPrintPublicationArticles($params);

var_dump($response->getResources());
