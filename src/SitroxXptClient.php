<?php

namespace Denner\Client;

use Denner\Client\Exception;
use Denner\Client\Response;
use function array_diff_key;
use function array_flip;
use function assert;
use function base64_encode;
use function sprintf;
use function var_dump;

/**
 * Sitrox XPT API client.
 *
 * @method Response\ResourceResponse getToken(array $params = [])
 * @method Response\ResourceResponse listMagazineWeeks(array $params = [])
 * @method Response\ResourceResponse getMagazine(array $params = [])
 */
class SitroxXptClient extends DennerClient
{
    const OPTION_BASE_URI = 'base_uri';
    const OPTION_CLIENT_ID = 'client_id';
    const OPTION_CLIENT_SECRET = 'client_secret';

    private string $authorizationString;

    public static function factory(array $options = []): SitroxXptClient
    {
        foreach ([self::OPTION_BASE_URI, self::OPTION_CLIENT_ID, self::OPTION_CLIENT_SECRET] as $optionName) {
            if (!isset($options[$optionName]) || $options[$optionName] === '') {
                throw new Exception\RuntimeException(
                    sprintf('Missing required configuration option "%s"', $optionName)
                );
            }
        }

        $client = parent::factory(array_diff_key($options, array_flip([self::OPTION_CLIENT_ID, self::OPTION_CLIENT_SECRET])));
        assert($client instanceof SitroxXptClient);

        // Need to get token using 2-legged OAuth 2.0: refs:
        // - https://stackoverflow.com/questions/14250383/how-does-2-legged-oauth-work-in-oauth-2-0
        // - https://developer.orange.com/tech_guide/2-legged-oauth-flow-step-by-step/
        $tokenResponse = $client->getToken([
            'Authorization' => 'Basic ' . base64_encode($options[self::OPTION_CLIENT_ID] . ':' . $options[self::OPTION_CLIENT_SECRET])
        ]);

        //var_dump($tokenResponse);
        //array(5) {
        //    ["access_token"]=> string(512) "...."
        //    ["token_type"]=> string(6) "Bearer"
        //    ["expires_in"]=> int(259200)
        //    ["refresh_token"]=> string(512) "...."
        //    ["scope"]=> string(3) "dag"
        //}
        // @todo Could save whole response and specially the refresh_token and expires_in,
        //       but in the context of this client is not needed, we have no long-running daemons/workers that access this API.

        // Private access is permitted because we are in same class
        $client->authorizationString = 'Bearer ' . $tokenResponse->getResource()->get('access_token');

        return $client;
    }

    public function getAuthorizationString(): string
    {
        return $this->authorizationString;
    }
}
