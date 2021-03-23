<?php

use Denner\Client\Response;

return [
    'name' => 'Denner Assets Service',
    'operations' => [
        'listAssets' => [
            'httpMethod' => 'GET',
            'uri' => 'assets',
            'summary' => 'List assets',
            'parameters' => [
                'page' => [
                    '$ref' => 'PageParam',
                ],
                'page_size' => [
                    '$ref' => 'PageSizeParam',
                ],
                'query' => [
                    'description' => 'Full text search query (currently searches only in asset name)',
                    'location' => 'query',
                    'type' => 'string',
                    'required' => false,
                ],
                'filter' => [
                    '$ref' => 'FilterParam',
                ],
                'sort' => [
                    '$ref' => 'SortParam',
                ],
            ],
            'responseClass' => Response\ListResponse::class,
            'responseDataRoot' => 'assets',
        ],
        'fetchAsset' => [
            'httpMethod' => 'GET',
            'uri' => 'assets/{asset_id}',
            'summary' => 'Fetch an asset',
            'parameters' => [
                'asset_id' => [
                    'description' => 'The ID of the asset to fetch',
                    'location' => 'uri',
                    'type' => 'string',
                    'required' => true,
                ],
            ],
            'responseClass' => Response\ResourceResponse::class,
            'data' => [
                'throw_exception_when_not_found' => false,
            ],
        ],
        'listAssetCollections' => [
            'httpMethod' => 'GET',
            'uri' => 'asset-collections',
            'summary' => 'List asset collections',
            'parameters' => [
                'page' => [
                    '$ref' => 'PageParam',
                ],
                'page_size' => [
                    '$ref' => 'PageSizeParam',
                ],
                'filter' => [
                    '$ref' => 'FilterParam',
                ],
                'sort' => [
                    '$ref' => 'SortParam',
                ],
            ],
            'responseClass' => Response\ListResponse::class,
            'responseDataRoot' => 'asset_collections',
        ],
        'listPurposes' => [
            'httpMethod' => 'GET',
            'uri' => 'purposes',
            'summary' => 'List asset purposes',
            'parameters' => [
                'page' => [
                    '$ref' => 'PageParam',
                ],
                'page_size' => [
                    '$ref' => 'PageSizeParam',
                ],
                'filter' => [
                    '$ref' => 'FilterParam',
                ],
                'sort' => [
                    '$ref' => 'SortParam',
                ],
            ],
            'responseClass' => Response\ListResponse::class,
            'responseDataRoot' => 'purposes',
        ],
    ],
    'models' => [
        'PageParam' => [
            'description' => 'The number of the page',
            'location' => 'query',
            'type' => 'integer',
            'required' => false,
        ],
        'PageSizeParam' => [
            'description' => 'The number of items to list on a page',
            'location' => 'query',
            'type' => 'integer',
            'required' => false,
        ],
        'Filter' => [
            'type' => 'object',
            'properties' => [
                'property' => [
                    'description' => 'The property to filter against',
                    'type' => 'string',
                    'required' => true,
                ],
                'value' => [
                    'description' => 'The value to filter against',
                    'type' => ['array', 'string', 'integer', 'boolean', 'number', 'numeric', 'object'],
                    'required' => true,
                ],
                'operator' => [
                    'description' => 'The operator the use for filtering',
                    'type' => 'string',
                    'required' => false,
                ],
                'type' => [
                    'description' => 'The data type of the value',
                    'type' => 'string',
                    'required' => false,
                ],
            ],
        ],
        'FilterParam' => [
            'description' => 'An array of filters',
            'location' => 'query',
            'type' => 'array',
            'required' => false,
            'items' => [
                '$ref' => 'Filter',
            ],
        ],
        'Sort' => [
            'type' => 'object',
            'properties' => [
                'property' => [
                    'description' => 'The property use for sorting',
                    'type' => 'string',
                    'required' => true,
                ],
                'direction' => [
                    'description' => 'The sorting direction (either "asc" or "desc")',
                    'type' => 'string',
                    'required' => false,
                ],
            ],
        ],
        'SortParam' => [
            'description' => 'An array of sorters',
            'location' => 'query',
            'type' => 'array',
            'required' => false,
            'items' => [
                '$ref' => 'Sort',
            ],
        ],
    ],
];
