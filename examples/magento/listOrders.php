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
    array(
        'Authorization' => sprintf('Bearer %s', $token),
        'searchCriteria' => array(
            'filterGroups' => array( // FilterGroups are connected with AND
                array(
                    'filters' => array( // Filters are connected with OR
                        array(
                            'field' => 'status',
                            'conditionType' => 'neq',
                            'value' => 'canceled',
                        ),
                    ),
                ),
                array(
                    'filters' => array(
                        array(
                            'field' => 'created_at',
                            'conditionType' => 'gt',
                            'value' => $from,
                        )
                    )
                ),
            ),
            'pageSize' => '5',
        ),
    )
);

var_dump($response->getResource());
// echo '<pre>'; print_r($response->getResource()->get('items'));

$orders = array();
foreach ($response->getResource()->get('items') as $order)  {
    //var_dump($order);
    $data = array(
        'increment_id' => $order['increment_id'],
        'items' => array(),
    );

    foreach ($order['items'] as $item) {
        //var_dump($item);
        $data['items'][] = sprintf('%s x %s: %s', $item['qty_ordered'], $item['sku'], $item['name']);
    }

    $orders[] = $data;
}

var_dump($orders);


