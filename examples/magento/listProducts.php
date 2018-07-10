<?php

use Denner\Client\MagentoClient;

$config = require realpath(__DIR__ . '/../bootstrap.php');

$client = MagentoClient::factory($config);

$token = @$_GET['token'] ?: false;

if (!$token) {
    throw new RuntimeException('Missing or invalid parameter "token"');
}

$response = $client->listProducts(
    [
        'Authorization' => sprintf('Bearer %s', $token),
        'searchCriteria' => [
            'filterGroups' => [ // FilterGroups are connected with AND
                [
                    'filters' => [ // Filters are connected with OR
                        [
                            'field' => 'status',
                            'conditionType' => 'eq',
                            'value' => '1', // 1 = online, other are offline
                        ],
                    ],
                ],
                [
                    'filters' => [
                        [
                            'field' => 'visibility',
                            'conditionType' => 'eq',
                            'value' => '4', // 4 = visible in the shop
                        ]
                    ]
                ],
                [
                    'filters' => [
                        [
                            'field' => 'attribute_set_id',
                            'conditionType' => 'eq',
                            'value' => '9', // 9 = wine, there might be banners too
                        ]
                    ]
                ],
            ],
            'pageSize' => '5',
        ],
    ]
);

var_dump($response->getResource());

echo '<pre>';
print_r($response->getResource()->get('items'));
