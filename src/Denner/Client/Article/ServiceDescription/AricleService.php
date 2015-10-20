<?php

return array(
    'name'        => 'Denner Webservices',
    'operations'  => array(
        'listArticle' => array(
            'httpMethod'       => 'GET',
            'uri'              => '',
            'summary'          => 'List assets',
            'parameters'       => array(
            ),
            'responseClass' => Array(),
        ),
        'oneArticle' => array(
            'httpMethod'       => 'GET',
            'uri'              => '{article_id}/',
            'summary'          => 'Fetch an asset',
            'parameters'       => array(
                'article_nr' => array(
                    'description' => 'The ID of the article fetch',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true,
                ),
            ),
            'responseClass' => 'Article',
        ),
        'oneArticleTextBlocks' => array(
            'httpMethod'       => 'GET',
            'uri'              => '{article_id}/text-blocks',
            'summary'          => 'List asset-types',
            'parameters'       => array(
                'article_nr' => array(
                    'description' => 'The ID of the article fetch',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true,
                ),
            ),
            'responseClass' => Array(),
        )
    ),
);
