<?php

namespace Denner\Client;

use Denner\Client\Response;
use Denner\Client\Subscriber;

/**
 * Magento 2 API client.
 *
 * @method Response\ResourceResponse integrationAdminToken(array $params = array())
 * @method Response\ResourceResponse listProducts(array $params = array())
 * @method Response\ResourceResponse getProductStock(array $params = array())
 * @method Response\ResourceResponse listOrders(array $params = array())
 */
class MagentoClient extends DennerClient
{
    const OPTION_USERNAME = 'username';
    const OPTION_PASSWORD = 'password';
}
