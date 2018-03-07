<?php

use Denner\Client\MagentoClient;

$config = require realpath(__DIR__ . '/../bootstrap.php');
$params = array(
);

$client = MagentoClient::factory($config);

$token = @$_GET['token'] ?: 'ajs8vvnm0vgk976iiqv6optdsjucp05r';

if (!$token) {
    throw new RuntimeException('Missing or invalid parameter "token"');
}

$response = $client->listProducts(
    array(
        'Authorisation' => sprintf('Bearer %s', $token),
        'searchCriteria' => array(
            'filterGroups' => array( // FilterGroups are connected with AND
                array(
                    'filters' => array( // FilterGroups are connected with OR
                        array(
                            'field' => 'status',
                            'value' => '1', // 1 = online,
                            'conditionType' => 'eq',
                        ),
                    ),
                ),
                array(
                    'filters' => array(
                        array(
                            'field' => 'visibility',
                            'value' => '4', // 4 = visible
                            'conditionType' => 'eq',
                        )
                    )
                ),
                array(
                    'filters' => array(
                        array(
                            'field' => 'attribute_set_id',
                            'value' => '9', // 9 = wine, there might be banners too
                            'conditionType' => 'eq',
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
