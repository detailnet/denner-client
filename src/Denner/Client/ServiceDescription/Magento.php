<?php

use Denner\Client\Response;

return array(
    'name' => 'Magento Commerce for B2B 2.2',
    'operations' => array(
        'integrationAdminTokenServiceV1' => array(
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
    ),
    'models' => array(
    ),
);
