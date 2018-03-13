<?php

use Denner\Client\MagentoClient;

$config = require realpath(__DIR__ . '/../bootstrap.php');

$client = MagentoClient::factory($config);

$token = @$_GET['token'] ?: false;

if (!$token) {
    throw new RuntimeException('Missing or invalid parameter "token"');
}

$response = $client->listProducts(
    array(
        'Authorization' => sprintf('Bearer %s', $token),
        'searchCriteria' => array(
            'filterGroups' => array( // FilterGroups are connected with AND
                array(
                    'filters' => array( // Filters are connected with OR
                        array(
                            'field' => 'status',
                            'conditionType' => 'eq',
                            'value' => '1', // 1 = online, other are offline
                        ),
                    ),
                ),
                array(
                    'filters' => array(
                        array(
                            'field' => 'visibility',
                            'conditionType' => 'eq',
                            'value' => '4', // 4 = visible in the shop
                        )
                    )
                ),
                array(
                    'filters' => array(
                        array(
                            'field' => 'attribute_set_id',
                            'conditionType' => 'eq',
                            'value' => '9', // 9 = wine, there might be banners too
                        )
                    )
                ),
            ),
            'pageSize' => '5',
        ),
    )
);

var_dump($response->getResource());
echo '<pre>'; print_r($response->getResource()->get('items'));
