<?php

use Denner\Client\MagentoClient;

$config = require realpath(__DIR__ . '/../bootstrap.php');

$client = MagentoClient::factory($config);

$token = @$_GET['token'] ?: false;
$from  = @$_GET['from'] ?: false;
$pageSize = @$_GET['page-size'] ?: '5';
$page  = @$_GET['page'] ?: '1';

if (!$token) {
    throw new RuntimeException('Missing or invalid parameter "token"');
}

if (!$from) {
    throw new RuntimeException('Missing or invalid parameter "from"');
}

$response = $client->listOrders(
    [
        'Authorization' => sprintf('Bearer %s', $token),
        'searchCriteria' => [
            'filterGroups' => [ // FilterGroups are connected with AND
                [
                    'filters' => [ // Filters are connected with OR
                        [
                            'field' => 'status',
                            'conditionType' => 'neq',
                            'value' => 'canceled',
                        ],
                    ],
                ],
                [
                    'filters' => [
                        [
                            'field' => 'created_at',
                            'conditionType' => 'gt',
                            'value' => $from,
                        ]
                    ]
                ],
            ],
            'sortOrders' => [
                [
                    'field' => 'created_at',
                    'direction' => 'ASC',
                ],
            ],
            'pageSize' => $pageSize,
            'currentPage' => $page,
        ],
    ]
);

// var_dump($response->getResource());
// echo '<pre>'; print_r($response->getResource()->get('items'));

$url = 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']);

foreach (['Previous page' => -1, 'Next page' => 1 ] as $operation => $inc) {
    $newPage = intval($page) + $inc;

    if ($newPage > 0) {
        $_GET['page'] = (string) $newPage;

        printf('<br/><a href="%s/listOrders.php?%s">%s</a>', $url, http_build_query($_GET), $operation);
    }
}


$orders = [];

foreach ($response->getResource()->get('items') as $order) {
    //var_dump($order);
    $data = [
        'increment_id' => $order['increment_id'],
        'created_at' => $order['created_at'],
        'items' => [],
    ];

    foreach ($order['items'] as $item) {
        //var_dump($item);
        $data['items'][] = sprintf('%s x %s: %s', $item['qty_ordered'], $item['sku'], $item['name']);
    }

    $orders[] = $data;
}

var_dump($orders);
