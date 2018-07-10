<?php

use Denner\Client\Response;

return [
    'name' => 'Denner Appraisal Service',
    'operations' => [
        'listRatings' => [
            'httpMethod' => 'GET',
            'uri' => 'ratings',
            'summary' => 'List articles rating',
            'parameters' => [
                'page' => [
                    '$ref' => 'PageParam',
                ],
                'page_size' => [
                    '$ref' => 'PageSizeParam',
                ],
                'f.count' => [
                    '$ref' => 'FilterCountParam',
                ],
                'f.value' => [
                    '$ref' => 'FilterValueParam',
                ],
                'sort' => [
                    '$ref' => 'SortParam',
                ],
            ],
            'responseClass' => Response\ListResponse::CLASS,
            'responseDataRoot' => 'ratings',
        ],
        'fetchRating' => [
            'httpMethod' => 'GET',
            'uri' => 'ratings/{article_id}',
            'summary' => 'Fetch an article rating',
            'parameters' => [
                'article_id' => [
                    'description' => 'The ID of the article (wine) rating to fetch',
                    'location' => 'uri',
                    'type' => 'string',
                    'required' => true,
                ],
            ],
            'responseClass' => Response\ResourceResponse::CLASS,
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
        'FilterCountParam' => [
            'description' =>
                'Filter by count, e.g. "f.count=__gte_10" will return all article rating infos which have at least 10 valid appraisals.',
            'location' => 'query',
            'type' => 'string',
            'required' => false
        ],
        'FilterValueParam' => [
            'description' =>
                'Filter by average value, e.g. "f.value=__gte_4" will return all article rating infos which value is at least 4.',
            'location' => 'query',
            'type' => 'string',
            'required' => false
        ],
        'SortParam' => [
            'description' => 'Sorter, e.g. "sort=value__asc" will sort by rating value',
            'location' => 'query',
            'type' => 'string',
            'required' => false,
        ],
    ],
];
