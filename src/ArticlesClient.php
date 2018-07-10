<?php

namespace Denner\Client;

use Denner\Client\Response;

/**
 * Denner Articles Service client.
 *
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
    /**
     * @param integer $year
     * @param integer $week
     * @param array $params
     * @return Response\ListResponse
     */
    public function listPromotionsByWeek($year, $week, array $params = [])
    {
        $filters = [
            'year' => ['property' => 'year', 'value' => $year, 'operator' => '=', 'type' => 'integer'],
            'week' => ['property' => 'week', 'value' => $week, 'operator' => '=', 'type' => 'integer'],
        ];

        // We may need to replace already existing filters
        $this->addOrReplaceFilters($filters, $params);

        return $this->listPromotions($params);
    }

    /**
     * @param integer $year
     * @param integer $week
     * @param array $params
     * @return Response\ListResponse
     */
    public function listAdvertisedArticlesByWeek($year, $week, array $params = [])
    {
        $filters = [
            'year' => ['property' => 'year', 'value' => $year, 'operator' => '=', 'type' => 'integer'],
            'week' => ['property' => 'week', 'value' => $week, 'operator' => '=', 'type' => 'integer'],
        ];

        // We may need to replace an already existing filter
        $this->addOrReplaceFilters($filters, $params);

        return $this->listAdvertisedArticles($params);
    }

    /**
     * @param string $promotionId
     * @param array $params
     * @return Response\ListResponse
     */
    public function listAdvertisedArticlesByPromotion($promotionId, array $params = [])
    {
        $filters = [
            'promotion.id' => ['property' => 'promotion.id', 'value' => $promotionId, 'operator' => '=', 'type' => 'string'],
        ];

        // We may need to replace an already existing filter
        $this->addOrReplaceFilters($filters, $params);

        return $this->listAdvertisedArticles($params);
    }
}
