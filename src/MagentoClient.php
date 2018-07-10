<?php

namespace Denner\Client;

use Denner\Client\Response;
use Denner\Client\Subscriber;

/**
 * Magento 2 API client.
 *
 * @method Response\PlainTextResponse getToken(array $params = [])
 * @method Response\ResourceResponse listProducts(array $params = [])
 * @method Response\ResourceResponse getProductStock(array $params = [])
 * @method Response\PlainTextResponse updateProductStock(array $params = [])
 * @method Response\ResourceResponse listOrders(array $params = [])
 */
class MagentoClient extends DennerClient
{
}