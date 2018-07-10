<?php

namespace Denner\Client;

use Denner\Client\Response;

/**
 * Denner Articles Service client.
 *
 * @method static AdvertisingClient factory(array $options = [])
 * @method Response\ListResponse listPrintPublications(array $params = [])
 * @method Response\ResourceResponse fetchPrintPublication(array $params = [])
 * @method Response\ListResponse listPrintPublicationArticles(array $params = [])
 * @method Response\ListResponse listPrintPublicationLinks(array $params = [])
 */
class AdvertisingClient extends DennerClient
{
}
