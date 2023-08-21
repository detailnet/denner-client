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
        ]
    ],
    'models' => [
    ],
];
