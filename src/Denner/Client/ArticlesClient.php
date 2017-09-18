<?php

namespace Denner\Client;

use GuzzleHttp\Command\Event\PreparedEvent;

use Denner\Client\Response;

/**
 * Denner Articles Service client.
 *
 * @method Response\ListResponse listAdvertisedArticles(array $params = array())
 * @method Response\ResourceResponse updateAdvertisedArticle(array $params = array())
 * @method Response\ListResponse listLanguages(array $params = array())
 * @method Response\ResourceResponse fetchLanguage(array $params = array())
 * @method Response\ListResponse listPromotions(array $params = array())
 */
class ArticlesClient extends DennerClient
{
    /**
     * @param array $params
     * @param string $broadcastAction
     * @return Response\ResourceResponse
     */
    public function fetchAdvertisedArticle(array $params = array(), $broadcastAction = null)
    {
        $command = $this->getCommand('fetchAdvertisedArticle', $params);

        if ($broadcastAction !== null) {
            $command->getEmitter()->on(
                'prepared',
                function (PreparedEvent $event) use ($broadcastAction) {
                    $event->getRequest()->setHeader($this->getBroadcastActionKey(), $broadcastAction);
                },
                'last'
            );
        }

        return $this->execute($command);
    }

    /**
     * @param integer $year
     * @param integer $week
     * @param array $params
     * @return Response\ListResponse
     */
    public function listPromotionsByWeek($year, $week, array $params = array())
    {
        $filters = array(
            'year' => array('property' => 'year', 'value' => $year, 'operator' => '=', 'type' => 'integer'),
            'week' => array('property' => 'week', 'value' => $week, 'operator' => '=', 'type' => 'integer'),
        );

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
    public function listAdvertisedArticlesByWeek($year, $week, array $params = array())
    {
        $filters = array(
            'year' => array('property' => 'year', 'value' => $year, 'operator' => '=', 'type' => 'integer'),
            'week' => array('property' => 'week', 'value' => $week, 'operator' => '=', 'type' => 'integer'),
        );

        // We may need to replace an already existing filter
        $this->addOrReplaceFilters($filters, $params);

        return $this->listAdvertisedArticles($params);
    }

    /**
     * @param string $promotionId
     * @param array $params
     * @return Response\ListResponse
     */
    public function listAdvertisedArticlesByPromotion($promotionId, array $params = array())
    {
        $filters = array(
            'promotion.id' => array('property' => 'promotion.id', 'value' => $promotionId, 'operator' => '=', 'type' => 'string'),
        );

        // We may need to replace an already existing filter
        $this->addOrReplaceFilters($filters, $params);

        return $this->listAdvertisedArticles($params);
    }
}
