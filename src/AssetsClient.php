<?php

namespace Denner\Client;

use Denner\Client\Response;

/**
 * Denner Assets Service client.
 *
 * @method static AssetsClient factory(array $options = [])
 * @method Response\ListResponse listAssets(array $params = [])
 * @method Response\ResourceResponse|null fetchAsset(array $params = [])
 * @method Response\ListResponse listAssetCollections(array $params = [])
 * @method Response\ListResponse listPurposes(array $params = [])
 */
class AssetsClient extends DennerClient
{
    public function listAssetCollectionsByUrlToken(string $urlToken, array $params = []): Response\ListResponse
    {
        $filters = [
            'url_token' => [
                'property' => 'links.url_token',
                'value' => $urlToken,
                'operator' => '=',
                'type' => 'string',
            ],
        ];

        // We may need to replace already existing filters
        $this->addOrReplaceFilters($filters, $params);

        return $this->listAssetCollections($params);
    }
}
