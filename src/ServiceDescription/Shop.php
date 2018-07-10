<?php

use Denner\Client\Response;

return [
    'name' => 'Denner Shop API',
    'operations' => [
        'createSweepstakeParticipant' => [
            'httpMethod' => 'POST',
            'uri' => 'sweepstake-participants',
            'summary' => 'Create a sweepstake participant',
            'parameters' => [
                /** @todo Define params properly and remove "additionalParameters" as catch-all... */
            ],
            'additionalParameters' => [
                'location' => 'json',
            ],
            'responseClass' => Response\ResourceResponse::CLASS,
        ],
        'createWineAppraisalVote' => [
            'httpMethod' => 'POST',
            'uri' => 'wines/{wine_id}/appraisals/{appraisal_id}/votes',
            'summary' => 'Vote on a wine appraisal',
            'parameters' => [
                'wine_id' => [
                    'description' => 'The ID of the wine for which to create the new vote',
                    'location' => 'uri',
                    'type' => 'string',
                    'required' => true,
                ],
                'appraisal_id' => [
                    'description' => 'The ID of the appraisal for which to create the new vote',
                    'location' => 'uri',
                    'type' => 'string',
                    'required' => true,
                ],
                /** @todo Define params properly and remove "additionalParameters" as catch-all... */
            ],
            'additionalParameters' => [
                'location' => 'json',
            ],
            'responseClass' => Response\ResourceResponse::CLASS,
        ],
        'createWineAppraisal' => [
            'httpMethod' => 'POST',
            'uri' => 'wines/{wine_id}/appraisals',
            'summary' => 'Create a wine appraisal',
            'parameters' => [
                'wine_id' => [
                    'description' => 'The ID of the wine for which to create the new appraisal',
                    'location' => 'uri',
                    'type' => 'string',
                    'required' => true,
                ],
                /** @todo Define actions properly and remove "additionalParameters" as catch-all... */
            ],
            'additionalParameters' => [
                'location' => 'json',
            ],
            'responseClass' => Response\ResourceResponse::CLASS,
        ],
        'listWineAppraisals' => [
            'httpMethod' => 'GET',
            'uri' => 'appraisals',
            'summary' => 'List appraisals',
            'parameters' => [
                'f.id' => [
                    'description' => 'Filter by ID',
                    'location' => 'query',
                    'type' => 'string',
                    'required' => false,
                ],
                'f.wine_id' => [
                    'description' => 'Filter by wine ID',
                    'location' => 'query',
                    'type' => 'string',
                    'required' => false,
                ],
                'f.shop_user_id' => [
                    'description' => 'Filter by Wineshop user ID',
                    'location' => 'query',
                    'type' => 'integer',
                    'required' => false,
                ],
                'f.email' => [
                    'description' => 'Filter by email address',
                    'location' => 'query',
                    'type' => 'string',
                    'required' => false,
                ],
                'f.source' => [
                    'description' => 'Filter by source',
                    'location' => 'query',
                    'type' => 'string',
                    'required' => false,
                ],
                'page' => [
                    '$ref' => 'PageParam',
                ],
                'page_size' => [
                    '$ref' => 'PageSizeParam',
                ],
                'sort' => [
                    '$ref' => 'SortParam',
                ],
            ],
            'responseClass' => Response\ListResponse::CLASS,
            'responseDataRoot' => 'appraisals',
        ],
        'listWineAppraisalsByWine' => [
            'httpMethod' => 'GET',
            'uri' => 'wines/{wine_id}/appraisals',
            'summary' => 'List the appraisals of a given wine',
            'parameters' => [
                'wine_id' => [
                    'description' => 'The ID of the wine for which to list the appraisals',
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
//                'sort' => array(
//                    '$ref' => 'SortParam',
//                ),
            ],
            'responseClass' => Response\ListResponse::CLASS,
            'responseDataRoot' => 'appraisals',
        ],
        'listWines' => [
            'httpMethod' => 'GET',
            'uri' => 'wines',
            'summary' => 'List wines',
            'parameters' => [
                'page' => [
                    '$ref' => 'PageParam',
                ],
                'page_size' => [
                    '$ref' => 'PageSizeParam',
                ],
                'sort' => [
                    '$ref' => 'SortParam',
                ],
                'filter' => [
                    '$ref' => 'FilterParam',
                ],
            ],
            'responseClass' => Response\ListResponse::CLASS,
            'responseDataRoot' => 'articles',
        ],
        'listWineGrowers' => [
            'httpMethod' => 'GET',
            'uri' => 'wine-growers',
            'summary' => 'List wine growers',
            'parameters' => [
                'page' => [
                    '$ref' => 'PageParam',
                ],
                'page_size' => [
                    '$ref' => 'PageSizeParam',
                ],
                'sort' => [
                    '$ref' => 'SortParam',
                ],
                'filter' => [
                    '$ref' => 'FilterParam',
                ],
            ],
            'responseClass' => Response\ListResponse::CLASS,
            'responseDataRoot' => 'wine_growers',
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
        'SortParam' => [
            'description' => 'The rules for sorting',
            'location' => 'query',
            'type' => 'string',
            'required' => false,
        ],
        'FilterParam' => [
            'description' => 'The rules for filtering',
            'location' => 'query',
            'type' => 'string',
            'required' => false,
        ],
    ],
];
