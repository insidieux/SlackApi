<?php
namespace SlackApi\Modules;

use SlackApi\AbstractModule;

/**
 * Class Oauth
 *
 * @link https://api.slack.com/methods#oauth
 *
 * @package SlackApi\Modules
 */
class Oauth extends AbstractModule
{
    /**
     * @link https://api.slack.com/methods/oauth.access
     *
     * @param string $clientId
     * @param string $clientSecret
     * @param string $code
     * @param string $redirect
     *
     * @return \SlackApi\Response
     */
    public function access($clientId, $clientSecret, $code, $redirect = '')
    {
        return $this->post('access', [
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
            'code'          => $code,
            'redirect'      => $redirect,
        ]);
    }
}
