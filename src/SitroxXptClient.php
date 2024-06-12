<?php

namespace Denner\Client;

use DateTime;
use Denner\Client\Exception;
use Denner\Client\Response;
use function array_diff_key;
use function array_flip;
use function assert;
use function base64_encode;
use function sprintf;

/**
 * Sitrox XPT API client.
 *
 * @method Response\ResourceResponse getToken(array $params = [])
 * @method Response\ResourceResponse listMagazineWeeks(array $params = [])
 * @method Response\ResourceResponse getMagazine(array $params = [])
 * @method Response\ResourceResponse getEvents(array $params = [])
 */
class SitroxXptClient extends DennerClient
{
    const OPTION_CLIENT_ID = self::OPTION_APP_ID;
    const OPTION_CLIENT_SECRET = self::OPTION_APP_KEY;

    private string $clientId;
    private string $clientSecret;
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

        // Create client without client options
        $client = parent::factory(array_diff_key($options, array_flip([self::OPTION_CLIENT_ID, self::OPTION_CLIENT_SECRET])));
        assert($client instanceof SitroxXptClient);

        $client->clientId = $options[self::OPTION_CLIENT_ID];
        $client->clientSecret = $options[self::OPTION_CLIENT_SECRET];

        return $client;
    }

    public function getAuthorizationString(): string
    {
        if (!isset($this->authorizationString)) {
            // Need to get token using 2-legged OAuth 2.0, refs:
            // - https://stackoverflow.com/questions/14250383/how-does-2-legged-oauth-work-in-oauth-2-0
            // - https://developer.orange.com/tech_guide/2-legged-oauth-flow-step-by-step/
            $tokenResponse = $this->getToken([
                'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret)
            ]);

            //var_dump($tokenResponse);
            //array(5) {
            //    ["access_token"]=> string(512) "...."
            //    ["token_type"]=> string(6) "Bearer"
            //    ["expires_in"]=> int(259200)
            //    ["refresh_token"]=> string(512) "...."
            //    ["scope"]=> string(3) "dag"
            //}
            /** @todo Could save whole response and specially the refresh_token and expires_in,
                      but in the context of this client is not needed, we have no long-running daemons/workers that access this API. */

            // Private access is permitted because we are in same class
            $this->authorizationString = 'Bearer ' . $tokenResponse->getResource()->get('access_token');
        }

        //if ($this->authorisationExpire <= (new DateTime())) {
        //    .. get token from refresh_token
        //}


        return $this->authorizationString;
    }
}
