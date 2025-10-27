<?php

use Denner\Client\Response;

return [
    'name' => 'Denner Stores Service',
    'operations' => [
        // Stores
        'listStores' => [
            'httpMethod' => 'GET',
            'uri' => 'stores',
            'summary' => 'List stores',
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
                'view-as' => [ // To use in Atlas transition
                    'description' => 'Different serialization view',
                    'location' => 'query',
                    'type' => 'string',
                    'required' => false,
                ]
            ],
            'responseClass' => Response\ListResponse::class,
            'responseDataRoot' => 'stores',
        ],
        'fetchStore' => [
            'httpMethod' => 'GET',
            'uri' => 'stores/{store_id}',
            'summary' => 'Fetch an store',
            'parameters' => [
                'store_id' => [
                    'description' => 'The ID or code of the store to fetch',
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
        //'updateStore' => [
        //    'httpMethod' => 'PATCH',
        //    'uri' => 'stores/{store_id}',
        //    'summary' => 'Update an store',
        //    'parameters' => [
        //        'store_id' => [
        //            'description' => 'The ID of the store to update',
        //            'location' => 'uri',
        //            'type' => 'string',
        //            'required' => true,
        //        ],
        //    ],
        //    'additionalParameters' => [
        //        'location' => 'json',
        //    ],
        //    'responseClass' => Response\ResourceResponse::class,
        //    'data' => [
        //        'throw_exception_when_not_found' => false,
        //    ],
        //],
        // Store Channels
        'listStoreChannels' => [
            'httpMethod' => 'GET',
            'uri' => 'store-channels',
            'summary' => 'List store channels',
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
            'responseDataRoot' => 'store_channels',
        ],
        // Store Services
        'listStoreServices' => [
            'httpMethod' => 'GET',
            'uri' => 'stores',
            'summary' => 'List store Services',
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
            'responseDataRoot' => 'store_services',
        ],
        // Store Flyers
        'listStoreFlyers' => [
            'httpMethod' => 'GET',
            'uri' => 'store-flyers',
            'summary' => 'List store flyers',
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
            'responseDataRoot' => 'flyers',
        ],
        'fetchStoreFlyer' => [
            'httpMethod' => 'GET',
            'uri' => 'store-flyers/{flyer_id}',
            'summary' => 'Fetch a store flyer',
            'parameters' => [
                'flyer_id' => [
                    'description' => 'The ID of the flyer to fetch',
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
        'updateStoreFlyer' => [
            'httpMethod' => 'PATCH',
            'uri' => 'store-flyers/{flyer_id}',
            'summary' => 'Update a store flyer',
            'parameters' => [
                'flyer_id' => [
                    'description' => 'The ID of the flyer to update',
                    'location' => 'uri',
                    'type' => 'string',
                    'required' => true,
                ],
            ],
            'additionalParameters' => [
                'location' => 'json',
            ],
            'responseClass' => Response\ResourceResponse::class,
            'data' => [
                'throw_exception_when_not_found' => false,
            ],
        ],
        //'createStoreFlyer' => [
        //    'httpMethod' => 'POST',
        //    'uri' => 'store-flyers',
        //    'summary' => 'Create a store flyer',
        //    'parameters' => [
        //        /** @todo Define params properly and remove "additionalParameters" as catch-all... */
        //    ],
        //    'additionalParameters' => [
        //        'location' => 'json',
        //    ],
        //    'responseClass' => Response\ResourceResponse::class,
        //],
        //'deleteStoreFlyer' => [
        //    'httpMethod' => 'DELETE',
        //    'uri' => 'store-flyers/{flyer_id}',
        //    'summary' => 'Delete a store flyer',
        //    'parameters' => [
        //        'flyer_id' => [
        //            'description' => 'The ID of the flyer to delete',
        //            'location' => 'uri',
        //            'type' => 'string',
        //            'required' => true,
        //        ],
        //    ],
        //    'additionalParameters' => [
        //        'location' => 'json',
        //    ],
        //    'responseClass' => Response\ResourceResponse::class, // Is an empty response
        //],
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
