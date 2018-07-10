<?php

use Denner\Client\Response;

return [
    'name' => 'Denner Translations Service',
    'operations' => [
        'listJobs' => [
            'httpMethod' => 'GET',
            'uri' => 'jobs',
            'summary' => 'List translation jobs',
            'parameters' => [
                'page' => [
                    '$ref' => 'PageParam',
                ],
                'page_size' => [
                    '$ref' => 'PageSizeParam',
                ],
                'f.item.type' => [
                    '$ref' => 'FilterItemTypeParam',
                ],
                'f.item.id' => [
                    '$ref' => 'FilterItemIdParam',
                ],
                'f.source_language' => [
                    '$ref' => 'FilterSourceLanguageParam',
                ],
                'f.status' => [
                    '$ref' => 'FilterStatusParam',
                ],
                'sort' => [
                    '$ref' => 'SortParam',
                ],
            ],
            'responseClass' => Response\ListResponse::CLASS,
            'responseDataRoot' => 'jobs',
        ],
        'updateJob' => [
            'httpMethod' => 'PATCH',
            'uri' => 'jobs/{id}',
            'summary' => 'Update a translation job',
            'parameters' => [
                'id' => [
                    'description' => 'The ID of the translation job to update',
                    'location' => 'uri',
                    'type' => 'string',
                    'required' => true,
                ],
            ],
            'additionalParameters' => [
                'location' => 'json',
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
        'FilterItemTypeParam' => [
            'description' =>
                'Filter by item type, e.g. "f.item.type=__streq_article" ' .
                'will return all translations jobs for article texts.',
            'location' => 'query',
            'type' => 'string',
            'required' => false
        ],
        'FilterItemIdParam' => [
            'description' =>
                'Filter by item id value (to be used in combination with f.item.type), ' .
                'e.g. "f.item.type=__streq_article&f.item.id=__in_051051||051052" ' .
                'will return all article translations jobs ' .
                'for articles "051051" and "051052" texts',
            'location' => 'query',
            'type' => 'string',
            'required' => false
        ],
        'FilterSourceLanguageParam' => [
            'description' =>
                'Filter by source_language, e.g. "f.source_language=__streq_de" ' .
                'will return all translations jobs whose source language is german',
            'location' => 'query',
            'type' => 'string',
            'required' => false
        ],
        'FilterStatusParam' => [
            'description' =>
                'Filter by status, e.g. "f.status=__in_open||translated" will return all translations jobs whose ' .
                'status is "open" or "translated"',
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
