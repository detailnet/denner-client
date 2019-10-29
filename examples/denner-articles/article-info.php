<?php

use Denner\Client\ArticlesClient;

$config = require realpath(__DIR__ . '/../bootstrap.php');

$articleId = @$_GET['article_id'] ?: '051583';
$quantity = @$_GET['quantity'] ?: 6;
$wineYear = @$_GET['wine_year'] ?: 2016;

if (!$articleId) {
    throw new RuntimeException('Missing or invalid parameter "article_id"');
}

$client = ArticlesClient::factory($config);

$response = $client->fetchArticle(
    [
        'article_id' => $articleId,
        'quantity' => (int) $quantity,
        'wine-year' => (int) $wineYear,
    ]
);

echo "<pre>";

print_r($response);
