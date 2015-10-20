<?php

return array(
    'name'        => 'Denner Webservices',
    'operations'  => array(
        'listArticle' => array(
            'httpMethod'       => 'GET',
            'uri'              => 'articles',
            'summary'          => 'List assets',
            'parameters'       => array(),
            'responseClass' =>"asList",
        ),
        'oneArticle' => array(
            'httpMethod'       => 'GET',
            'uri'              => 'articles/{article_id}/',
            'summary'          => 'Fetch an asset',
            'parameters'       => array(
                'article_nr' => array(
                    'description' => 'The ID of the article fetch',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true,
                ),
            ),
            'responseClass' =>  Array(),
        ),
        'oneArticleTextBlocks' => array(
            'httpMethod'       => 'GET',
            'uri'              => 'articles/{article_id}/text-blocks',
            'summary'          => 'List asset-types',
            'parameters'       => array(
                'article_nr' => array(
                    'description' => 'The ID of the article fetch',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true,
                ),
            ),
            'responseClass' =>  Array(),
        )
    ),
    'models' => array(
        'asList' => array(
            'properties' => array(
                "articles" => ServiceArticle
            )

    )
);
