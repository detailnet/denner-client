<?php

use Denner\Client\MagentoClient;

$config = require realpath(__DIR__ . '/../bootstrap.php');

$client = MagentoClient::factory($config);

$token = @$_GET['token'] ?: false;
$from  = @$_GET['from'] ?: false;

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
            'pageSize' => '5',
        ],
    ]
);

var_dump($response->getResource());
// echo '<pre>'; print_r($response->getResource()->get('items'));

$orders = [];

foreach ($response->getResource()->get('items') as $order)  {
    //var_dump($order);
    $data = [
        'increment_id' => $order['increment_id'],
        'items' => [],
    ];

    foreach ($order['items'] as $item) {
        //var_dump($item);
        $data['items'][] = sprintf('%s x %s: %s', $item['qty_ordered'], $item['sku'], $item['name']);
    }

    $orders[] = $data;
}

var_dump($orders);


