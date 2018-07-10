<?php

namespace Denner\Client;

use Denner\Client\Response;

/**
 * Magento 2 API client.
 *
 * @method static MagentoClient factory(array $options = [])
 * @method Response\PlainTextResponse getToken(array $params = [])
 * @method Response\ResourceResponse listProducts(array $params = [])
 * @method Response\ResourceResponse getProductStock(array $params = [])
 * @method Response\PlainTextResponse updateProductStock(array $params = [])
 * @method Response\ResourceResponse listOrders(array $params = [])
 */
class MagentoClient extends DennerClient
{
}
