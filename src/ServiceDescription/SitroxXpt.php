<?php

use Denner\Client\Response;

return [
    'name' => 'Sitrox Aktionsplanungstool (XPT)',
    'operations' => [
        'getToken' => [
            'httpMethod' => 'POST',
            'uri' => 'oauth/token',
            'summary' => 'Create access token for given credentials.',
            'parameters' => [
                'Authorization' => [
                    'location' => 'header',
                    'type' => 'string',
                    'required' => true,
                ],
                'grant_type' => [
                    'location' => 'body',
                    'type' => 'string',
                    'required' => false,
                    'default' => 'client_credentials'
                ],
                'scope' => [
                    'location' => 'body',
                    'type' => 'string',
                    'required' => false,
                    'default' => 'dag'
                ],
            ],
            'responseClass' => Response\ResourceResponse::class,
        ],
        'listMagazineWeeks' => [
            'httpMethod' => 'GET',
            'uri' => 'api/dag/v1/magazine_available_year_weeks',
            'summary' => 'Get weeks that contain a magazines.',
            'parameters' => [
                'Authorization' => [
                    'location' => 'header',
                    'type' => 'string',
                    'required' => true,
                ],
                'year' => [
                    'location' => 'query',
                    'type' => 'number',
                    'required' => true,
                ],
            ],
            'responseClass' => Response\ResourceResponse::class,
        ],
        'getMagazine' => [
            'httpMethod' => 'GET',
            'uri' => 'api/dag/v1/magazines',
            'summary' => 'Get magazine.',
            'parameters' => [
                'Authorization' => [
                    'location' => 'header',
                    'type' => 'string',
                    'required' => true,
                ],
                'year_week' => [
                    'location' => 'query',
                    'type' => 'number',
                    'required' => true,
                ],
            ],
            'responseClass' => Response\ResourceResponse::class,
        ],
        'getEvents' => [
            'httpMethod' => 'GET',
            'uri' => 'api/dag/v1/events',
            'summary' => 'Get events.',
            'parameters' => [
                'Authorization' => [
                    'location' => 'header',
                    'type' => 'string',
                    'required' => true,
                ],
                'year_week' => [
                    'location' => 'query',
                    'type' => 'number',
                    'required' => true,
                ],
            ],
            'responseClass' => Response\ResourceResponse::class,
        ],
        'listEvents' => [
            'httpMethod' => 'GET',
            'uri' => 'api/dag/v1/events',
            'summary' => 'List events.',
            'parameters' => [
                'Authorization' => [
                    'location' => 'header',
                    'type' => 'string',
                    'required' => true,
                ],
                'year_week' => [
                    'location' => 'query',
                    'type' => 'number',
                    'required' => true,
                ],
            ],
            'responseClass' => Response\ListResponse::class,
            'responseDataRoot' => 'events',
        ],
        'getAdvert' => [
            'httpMethod' => 'GET',
            'uri' => 'api/dag/v1/adverts',
            'summary' => 'Get adverts.',
            'parameters' => [
                'Authorization' => [
                    'location' => 'header',
                    'type' => 'string',
                    'required' => true,
                ],
                'year_week' => [
                    'location' => 'query',
                    'type' => 'number',
                    'required' => true,
                ],
            ],
            'responseClass' => Response\ResourceResponse::class,
        ],
        // Alternative, fetch pages as listing
        'listAdverts' => [
            'httpMethod' => 'GET',
            'uri' => 'api/dag/v1/adverts',
            'summary' => 'Get adverts.',
            'parameters' => [
                'Authorization' => [
                    'location' => 'header',
                    'type' => 'string',
                    'required' => true,
                ],
                'year_week' => [
                    'location' => 'query',
                    'type' => 'number',
                    'required' => true,
                ],
            ],
            'responseClass' => Response\ListResponse::class,
            'responseDataRoot' => 'pages',
        ],
    ],
    'models' => [
    ],
];
