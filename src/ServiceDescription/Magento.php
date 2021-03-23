<?php

use Denner\Client\Response;

return [
    'name' => 'Magento Commerce for B2B 2.2',
    'operations' => [
        'getToken' => [
            //'tag' => 'integrationAdminTokenServiceV1',
            'httpMethod' => 'POST',
            'uri' => 'V1/integration/admin/token',
            'summary' => 'Create access token for admin given the admin credentials.',
            'parameters' => [
                'username' => [
                    'location' => 'json',
                    'type' => 'string',
                    'required' => true,
                ],
                'password' => [
                    'location' => 'json',
                    'type' => 'string',
                    'required' => true,
                ],
            ],
            'responseClass' => Response\PlainTextResponse::class,
        ],
        'listProducts' => [
            //'tag' => 'catalogProductRepositoryV1',
            'httpMethod' => 'GET',
            'uri' => 'V1/products',
            'summary' => 'Get products that match specified search criteria.',
            'parameters' => [
                'Authorization' => [
                    'location' => 'header',
                    'type' => 'string',
                    'required' => true,
                ],
                'searchCriteria' =>  [
                    '$ref' => 'SearchCriteriaParam',
                ],
            ],
            'responseClass' => Response\ResourceResponse::class,
        ],
        'getProductStock' => [
            //'tag' => 'catalogInventoryStockRegistryV1',
            'httpMethod' => 'GET',
            'uri' => 'V1/stockStatuses/{productSku}',
            'summary' => 'Get stock status for a wine.',
            'parameters' => [
                'productSku' => [
                    'location' => 'uri',
                    'type' => 'string',
                    'required' => true,
                ],
                'Authorization' => [
                    'location' => 'header',
                    'type' => 'string',
                    'required' => true,
                ],
                'scopeId' =>  [
                    'type' => 'number',
                    'required' => false,
                ],
            ],
            'responseClass' => Response\ResourceResponse::class,
        ],
        'updateProductStock' => [
            //'tag' => 'catalogInventoryStockRegistryV1',
            'httpMethod' => 'PUT',
            'uri' => 'V1/products/{productSku}/stockItems/{itemId}',
            'summary' => 'Update stock for a wine.',
            'parameters' => [
                'productSku' => [
                    'location' => 'uri',
                    'type' => 'string',
                    'required' => true,
                ],
                'itemId' => [
                    'location' => 'uri',
                    'type' => 'string',
                    'required' => true,
                ],
                'Authorization' => [
                    'location' => 'header',
                    'type' => 'string',
                    'required' => true,
                ],
                'stockItem' => [
                    '$ref' => 'StockItemParam',
                ],
            ],
            'responseClass' => Response\PlainTextResponse::class,
        ],
        'listOrders' => [
            //'tag' => 'salesOrderRepositoryV1',
            'httpMethod' => 'GET',
            'uri' => 'V1/orders',
            'summary' => 'Lists orders that match specified search criteria.',
            'parameters' => [
                'Authorization' => [
                    'location' => 'header',
                    'type' => 'string',
                    'required' => true,
                ],
                'searchCriteria' =>  [
                    '$ref' => 'SearchCriteriaParam',
                ],
            ],
            'responseClass' => Response\ResourceResponse::class,
        ],
    ],
    'models' => [
        'SearchCriteriaParam' => [
            'location' => 'query',
            'type' => 'array',
            'required' => true,
            'items' => [
                'filterGroups' => [
                    'type' => 'array',
                    'description' => 'Filter groups, are connected as AND where condition',
                    'items' => [
                        '$ref' => 'FilterGroup'
                    ],
                ],
                'sortOrders' => [
                    'description' => 'An array of sorters',
                    'type' => 'array',
                    'items' => [
                        '$ref' => 'SortOrder'
                    ],
                ],
                'pageSize' => [
                    'type' => 'string',
                ],
                'currentPage' => [
                    'type' => 'string',
                ],
            ],
        ],
        'FilterGroup' => [
            'type' => 'object',
            'properties' => [
                'filters' => [
                    'type' => 'array',
                    'description' => 'Filters, are connected as OR where condition',
                    'required' => true,
                    'items' => [
                        '$ref' => 'Filter'
                    ],
                ],
            ],
        ],
        'Filter' => [
            'type' => 'object',
            'properties' => [
                'field' => [
                    'type' => 'string',
                    'required' => true,
                ],
                'value' => [
                    'type' => 'string',
                    'required' => false,
                ],
                'conditionType' => [
                    'type' => 'string',
                    'required' => false,
                ],
            ],
        ],
        'SortOrder' => [
            'type' => 'object',
            'properties' => [
                'field' => [
                    'description' => 'The property use for sorting',
                    'type' => 'string',
                    'required' => true,
                ],
                'direction' => [
                    'description' => 'Direction of the sort (ASC|DESC)',
                    'type' => 'string',
                    'required' => false,
                ],
            ],
        ],
        'StockItemParam' => [
            'location' => 'json',
            'type' => 'object',
            'properties' => [
                'qty' => [
                    'type' => 'integer',
                    'required' => true,
                ],
                'is_in_stock' => [
                    'type' => 'boolean',
                    'required' => false,
                ],
            ],
        ],
    ],
];
