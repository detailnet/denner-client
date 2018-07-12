<?php

namespace Denner\Client;

use Denner\Client\Response;

/**
 * Denner Translations Service client.
 *
 * @method static TranslationsClient factory(array $options = [])
 * @method Response\ListResponse listJobs(array $params = [])
 * @method Response\ResourceResponse|null updateJob(array $params = [])
 */
class TranslationsClient extends DennerClient
{
    public function listJobsByArticle(string $articleId, array $params = []): Response\ListResponse
    {
        $params['f.item.type'] = '__streq_article';
        $params['f.item.id'] = '__streq_' . $articleId;

        return $this->listJobs($params);
    }

    public function listTranslatedJobs(array $params = []): Response\ListResponse
    {
        $params['f.status'] = '__streq_translated';

        return $this->listJobs($params);
    }
}
