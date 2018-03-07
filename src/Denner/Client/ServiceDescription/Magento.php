<?php

use Denner\Client\Response;

return array(
    'name' => 'Magento Commerce for B2B 2.2',
    'operations' => array(
        'integrationAdminToken' => array(
            //'tag' => 'integrationAdminTokenServiceV1',
            'httpMethod' => 'POST',
            'uri' => 'V1/integration/admin/token',
            'summary' => 'Create access token for admin given the admin credentials.',
            'parameters' => array(
                'username' => array(
                    'location' => 'json',
                    'type' => 'string',
                    'required' => true,
                ),
                'password' => array(
                    'location' => 'json',
                    'type' => 'string',
                    'required' => true,
                ),
            ),
            'responseClass' => Response\ResourceResponse::CLASS,
        ),
        'listProducts' => array(
            //'tag' => 'catalogProductRepositoryV1',
            'httpMethod' => 'GET',
            'uri' => 'V1/products',
            'summary' => 'Get products that match specified search criteria.',
            'parameters' => array(
                'Authorization' => array(
                    'location' => 'header',
                    'type' => 'string',
                    'required' => true,
                ),
                'searchCriteria' =>  array(
                    '$ref' => 'SearchCriteria',
                ),
            ),
            'responseClass' => Response\ResourceResponse::CLASS,
        ),
        'getProductStock' => array(
            //'tag' => 'catalogInventoryStockRegistryV1',
            'httpMethod' => 'GET',
            'uri' => 'V1/stockStatuses/{productSku}',
            'summary' => 'Get stock status for a wine.',
            'parameters' => array(
                'productSku' => array(
                    'location' => 'uri',
                    'type' => 'string',
                    'required' => true,
                ),
                'Authorization' => array(
                    'location' => 'header',
                    'type' => 'string',
                    'required' => true,
                ),
                'scopeId' =>  array(
                    'type' => 'number',
                    'required' => false,
                ),
            ),
            'responseClass' => Response\ResourceResponse::CLASS,
        ),
        'listOrders' => array(
            //'tag' => 'salesOrderRepositoryV1',
            'httpMethod' => 'GET',
            'uri' => 'V1/orders',
            'summary' => 'Lists orders that match specified search criteria.',
            'parameters' => array(
                'Authorization' => array(
                    'location' => 'header',
                    'type' => 'string',
                    'required' => true,
                ),
                'searchCriteria' =>  array(
                    '$ref' => 'SearchCriteria',
                ),
            ),
            'responseClass' => Response\ResourceResponse::CLASS,
        ),
    ),
    'models' => array(
        'SearchCriteria' => array(
            'location' => 'query',
            'type' => 'array',
            'required' => true,
            'items' => array(
                'filterGroups' => array(
                    'type' => 'array',
                    'description' => 'Filter groups, are connected as AND where condition',
                    'items' => array(
                        '$ref' => 'FilterGroup'
                    ),
                ),
                'sortOrders' => array(
                    'description' => 'An array of sorters',
                    'type' => 'array',
                    'items' => array(
                        '$ref' => 'SortOrder'
                    ),
                ),
                'pageSize' => array(
                    'type' => 'string',
                ),
                'currentPage' => array(
                    'type' => 'string',
                ),
            ),
        ),
        'FilterGroup' => array(
            'type' => 'object',
            'properties' => array(
                'filters' => array(
                    'type' => 'array',
                    'description' => 'Filters, are connected as OR where condition',
                    'required' => true,
                    'items' => array(
                        '$ref' => 'Filter'
                    ),
                ),
            ),
        ),
        'Filter' => array(
            'type' => 'object',
            'properties' => array(
                'field' => array(
                    'type' => 'string',
                    'required' => true,
                ),
                'value' => array(
                    'type' => 'string',
                    'required' => false,
                ),
                'conditionType' => array(
                    'type' => 'string',
                    'required' => false,
                ),
            ),
        ),
        'SortOrder' => array(
            'type' => 'object',
            'properties' => array(
                'field' => array(
                    'description' => 'The property use for sorting',
                    'type' => 'string',
                    'required' => true,
                ),
                'direction' => array(
                    'type' => 'string',
                    'required' => false,
                ),
            ),
        ),
    ),
);
