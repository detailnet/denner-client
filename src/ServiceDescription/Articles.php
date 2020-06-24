<?php

use Denner\Client\Response;

return [
    'name' => 'Denner Articles Service',
    'operations' => [
        // Advertised articles
        'listAdvertisedArticles' => [
            'httpMethod' => 'GET',
            'uri' => 'advertised-articles',
            'summary' => 'List advertised articles',
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
            'responseClass' => Response\ListResponse::CLASS,
            'responseDataRoot' => 'advertised_articles',
        ],
        'fetchAdvertisedArticle' => [
            'httpMethod' => 'GET',
            'uri' => 'advertised-articles/{advertised_article_id}',
            'summary' => 'Fetch an advertisedArticle',
            'parameters' => [
                'advertised_article_id' => [
                    'description' => 'The ID of the advertised article to fetch',
                    'location' => 'uri',
                    'type' => 'string',
                    'required' => true,
                ],
                'broadcast_actions' => [
                    'description' => 'Request for broadcast',
                    'location' => 'header',
                    'sentAs' => 'X-Denner-Broadcast',
                    'type' => 'string',
                    'required' => false,
                ],
            ],
            'responseClass' => Response\ResourceResponse::CLASS,
            'data' => [
                'throw_exception_when_not_found' => false,
            ],
        ],
        'updateAdvertisedArticle' => [
            'httpMethod' => 'PATCH',
            'uri' => 'advertised-articles/{advertised_article_id}',
            'summary' => 'Update an advertisedArticle',
            'parameters' => [
                'advertised_article_id' => [
                    'description' => 'The ID of the advertised article to update',
                    'location' => 'uri',
                    'type' => 'string',
                    'required' => true,
                ],
            ],
            'additionalParameters' => [
                'location' => 'json',
            ],
            'responseClass' => Response\ResourceResponse::CLASS,
            'data' => [
                'throw_exception_when_not_found' => false,
            ],
        ],
        // Articles
        'fetchArticle' => [
            'httpMethod' => 'GET',
            'uri' => 'articles/{article_id}',
            'summary' => 'Fetch an article',
            'parameters' => [
                'article_id' => [
                    'description' => 'The ID of the article to fetch',
                    'location' => 'uri',
                    'type' => 'string',
                    'required' => true,
                ],
                'quantity' => [
                    'description' => 'Quantity (for texts and price)',
                    'location' => 'query',
                    'required' => false,
                    'type' => 'integer',
                ],
                'price-selection' => [
                    '$ref' => 'PriceSelectionParam',
                ],
                'hundred-gram-prices' => [
                    'description' => 'Apply 100 gram promotion to prices?',
                    'location' => 'query',
                    'required' => false,
                    'type' => ['boolean', 'string', 'integer'], // For true string values 'true', 'yes', 'ja', '1' are accepted
                ],
                'wine-year' => [
                    'description' => 'Wine year (for wine experts/medals)',
                    'location' => 'query',
                    'required' => false,
                    'type' => 'integer',
                    'minimum' => 1900
                ],
                'broadcast_actions' => [
                    'description' => 'Request for broadcast',
                    'location' => 'header',
                    'sentAs' => 'X-Denner-Broadcast',
                    'type' => 'string',
                    'required' => false,
                ],
            ],
            'responseClass' => Response\ResourceResponse::CLASS,
            'data' => [
                'throw_exception_when_not_found' => false,
            ],
        ],
        // Languages
        'listLanguages' => [
            'httpMethod' => 'GET',
            'uri' => 'languages',
            'summary' => 'List languages',
            'parameters' => [
                'page' => [
                    '$ref' => 'PageParam',
                ],
                'page_size' => [
                    '$ref' => 'PageSizeParam',
                ],
//                ),
                'filter' => [
                    '$ref' => 'FilterParam',
                ],
                'sort' => [
                    '$ref' => 'SortParam',
                ],
            ],
            'responseClass' => Response\ListResponse::CLASS,
            'responseDataRoot' => 'languages',
        ],
        // Promotions
        'listPromotions' => [
            'httpMethod' => 'GET',
            'uri' => 'promotions',
            'summary' => 'List promotions',
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
            'responseClass' => Response\ListResponse::CLASS,
            'responseDataRoot' => 'promotions',
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
        'PriceSelectionParam' => [
            'description' => 'Price selection',
            'location' => 'query',
            'required' => false,
            'type' => 'object',
            'properties' => [
                'valid_on' => [
                    'description' => 'Price for day (Default "today")',
                    'type' => 'string',
                    'required' => false,
                ],
                'level' => [
                    'description' => 'Price level',
                    'type' => 'integer',
                    'required' => false,
                ],
                'channel' => [
                    'description' => 'Price channel',
                    'type' => 'integer',
                    'required' => false,
                ],
                'price_region' => [
                    'description' => 'Price region',
                    'type' => 'string',
                    'required' => false,
                ],
            ],
        ],
    ],
];
