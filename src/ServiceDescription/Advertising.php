<?php

use Denner\Client\Response;

return [
    'name' => 'Denner Advertising Service',
    'operations' => [
        'listPrintPublicationLinks' => [
            'httpMethod' => 'GET',
            'uri' => 'print-publication-links',
            'summary' => 'List print publication links',
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
            'responseDataRoot' => 'print_publication_links',
        ],
        'listPrintPublications' => [
            'httpMethod' => 'GET',
            'uri' => 'print-publications',
            'summary' => 'List print publications',
            'parameters' => [
                'page' => [
                    '$ref' => 'PageParam',
                ],
                'page_size' => [
                    '$ref' => 'PageSizeParam',
                ],
//                'query' => array(
//                    'description' => 'Full text search query (currently searches only in advertised article name)',
//                    'location' => 'query',
//                    'type' => 'string',
//                    'required' => false,
//                ),
                'filter' => [
                    '$ref' => 'FilterParam',
                ],
                'sort' => [
                    '$ref' => 'SortParam',
                ],
            ],
            'responseClass' => Response\ListResponse::class,
            'responseDataRoot' => 'print_publications',
        ],
        'fetchPrintPublication' => [
            'httpMethod' => 'GET',
            'uri' => 'print-publications/{print_publication_id}',
            'summary' => 'Fetch a print publication',
            'parameters' => [
                'print_publication_id' => [
                    'description' => 'The ID of the print publication to fetch',
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
        'listPrintPublicationArticles' => [
            'httpMethod' => 'GET',
            'uri' => 'print-publications/{print_publication_id}/articles',
            'summary' => 'List print publication articles',
            'parameters' => [
                'print_publication_id' => [
                    'description' => 'The ID of the print publication to fetch the articles from',
                    'location' => 'uri',
                    'type' => 'string',
                    'required' => true,
                ],
                'page' => [
                    '$ref' => 'PageParam',
                ],
                'page_size' => [
                    '$ref' => 'PageSizeParam',
                ],
            ],
            'responseClass' => Response\ListResponse::class,
            'responseDataRoot' => 'print_publication_articles',
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
