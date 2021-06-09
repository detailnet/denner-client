<?php

namespace Denner\Client;

use Denner\Client\Response;

/**
 * Denner Articles Service client.
 * @method static StoresClient factory(array $options = [])
 * @method Response\ListResponse listStores(array $params = [])
 * @method Response\ResourceResponse|null fetchStore(array $params = [])
 * @method Response\ListResponse listStoreChannels(array $params = [])
 * @method Response\ListResponse listStoreServices(array $params = [])
 * @method Response\ListResponse listStoreFlyers(array $params = [])
 * @method Response\ResourceResponse|null fetchStoreFlyer(array $params = [])
 * @method Response\ResourceResponse|null updateStoreFlyer(array $params = [])
 */
class StoresClient extends DennerClient
{
}
