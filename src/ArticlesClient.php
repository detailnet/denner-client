<?php

namespace Denner\Client;

use Denner\Client\Response;

/**
 * Denner Articles Service client.
 * @method static ArticlesClient factory(array $options = [])
 * @method Response\ListResponse listAdvertisedArticles(array $params = [])
 * @method Response\ResourceResponse|null fetchAdvertisedArticle(array $params = [])
 * @method Response\ResourceResponse|null updateAdvertisedArticle(array $params = [])
 * @method Response\ResourceResponse|null fetchArticle(array $params = [])
 * @method Response\ListResponse listAdHocArticles(array $params = [])
 * @method Response\ResourceResponse|null fetchAdHocArticle(array $params = [])
 * @method Response\ListResponse listLanguages(array $params = [])
 * @method Response\ListResponse listPromotions(array $params = [])
 * @method Response\ListResponse listXptEvents(array $params = [])
 * @method Response\ResourceResponse|null fetchXptEvent(array $params = [])
 * @method Response\ListResponse listXptFeaturedArticles(array $params = [])
 * @method Response\ResourceResponse|null fetchXptFeaturedArticle(array $params = [])
 * @method Response\ListResponse listXptPublications(array $params = [])
 * @method Response\ResourceResponse|null fetchXptPublication(array $params = [])
 */
class ArticlesClient extends DennerClient
{
    public function listPromotionsByWeek(int $year, int $week, array $params = []): Response\ListResponse
    {
        $filters = [
            'year' => ['property' => 'year', 'value' => $year, 'operator' => '=', 'type' => 'integer'],
            'week' => ['property' => 'week', 'value' => $week, 'operator' => '=', 'type' => 'integer'],
        ];

        // We may need to replace already existing filters
        $this->addOrReplaceFilters($filters, $params);

        return $this->listPromotions($params);
    }

    public function listAdvertisedArticlesByWeek(int $year, int $week, array $params = []): Response\ListResponse
    {
        $filters = [
            'year' => ['property' => 'year', 'value' => $year, 'operator' => '=', 'type' => 'integer'],
            'week' => ['property' => 'week', 'value' => $week, 'operator' => '=', 'type' => 'integer'],
        ];

        // We may need to replace an already existing filter
        $this->addOrReplaceFilters($filters, $params);

        return $this->listAdvertisedArticles($params);
    }

    public function listAdvertisedArticlesByPromotion(
        string $promotionId,
        array $params = [],
        bool $onlyScreenable = false
    ): Response\ListResponse {
        $filters = [
            'promotion.id' => [
                'property' => 'promotion.id',
                'value' => $promotionId,
                'operator' => '=',
                'type' => 'string',
            ],
        ];

        if ($onlyScreenable) {
            $filters[] = [ // Advertised articles with at least one screen
                'property' => 'screens.0',
                'operator' => 'exists',
                'value' => true,
                'type' => 'boolean',
            ];
        }

        // We may need to replace an already existing filter
        $this->addOrReplaceFilters($filters, $params);

        return $this->listAdvertisedArticles($params);
    }

    public function getAdvertisedArticleByArticleSelection(
        string $promotionId,
        string $articleId,
        int $quantity
    ): ?Response\Resource {
        $results = $this->listAdvertisedArticles(
            [
                'filter' => [
                    [
                        'property' => 'promotion',
                        'value' => $promotionId,
                        'operator' => '=',
                        'type' => 'string',
                    ],
                    [
                        'property' => 'article_id',
                        'value' => $articleId,
                        'operator' => '=',
                        'type' => 'string',
                    ],
                    [
                        'property' => 'quantity',
                        'value' => $quantity,
                        'operator' => '=',
                        'type' => 'integer',
                    ],
                ],
            ]
        );

        return $results->getResourceCount() === 1 ? $results->getResources()[0] : null;
    }

    public function listAdHocArticlesByWeek(int $year, int $week, array $params = []): Response\ListResponse
    {
        $filters = [
            'year' => ['property' => 'year', 'value' => $year, 'operator' => '=', 'type' => 'integer'],
            'week' => ['property' => 'week', 'value' => $week, 'operator' => '=', 'type' => 'integer'],
        ];

        // We may need to replace an already existing filter
        $this->addOrReplaceFilters($filters, $params);

        return $this->listAdHocArticles($params);
    }
}
