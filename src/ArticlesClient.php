<?php

namespace Denner\Client;

use Denner\Client\Response;

/**
 * Denner Articles Service client.
 *
 * @method static ArticlesClient factory(array $options = [])
 * @method Response\ListResponse listAdvertisedArticles(array $params = [])
 * @method Response\ResourceResponse fetchAdvertisedArticle(array $params = [])
 * @method Response\ResourceResponse updateAdvertisedArticle(array $params = [])
 * @method Response\ResourceResponse fetchArticle(array $params = [])
 * @method Response\ListResponse listLanguages(array $params = [])
 * @method Response\ResourceResponse fetchLanguage(array $params = [])
 * @method Response\ListResponse listPromotions(array $params = [])
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

    public function listAdvertisedArticlesByPromotion(string $promotionId, array $params = []): Response\ListResponse
    {
        $filters = [
            'promotion.id' => [
                'property' => 'promotion.id',
                'value' => $promotionId,
                'operator' => '=',
                'type' => 'string',
            ],
        ];

        // We may need to replace an already existing filter
        $this->addOrReplaceFilters($filters, $params);

        return $this->listAdvertisedArticles($params);
    }
}
