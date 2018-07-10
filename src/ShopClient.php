<?php

namespace Denner\Client;

use Denner\Client\Response;

/**
 * Denner Shop API client.
 *
 * @method static ShopClient factory(array $options = [])
 * @method Response\ResourceResponse createSweepstakeParticipant(array $params = [])
 * @method Response\ResourceResponse createWineAppraisalVote(array $params = [])
 * @method Response\ResourceResponse createWineAppraisal(array $params = [])
 * @method Response\ListResponse listWineAppraisals(array $params = [])
 * @method Response\ListResponse listWineAppraisalsByWine(array $params = [])
 * @method Response\ListResponse listWines(array $params = [])
 * @method Response\ListResponse listWineGrowers(array $params = [])
 */
class ShopClient extends DennerClient
{
}
