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
     * @param string $id
     * @param string $secret
     * @param string $code
     * @param string $redirect
     *
     * @return \SlackApi\Response
     */
    public function access($id, $secret, $code, $redirect = '')
    {
        return $this->post('access', [
            'client_id'     => $id,
            'client_secret' => $secret,
            'code'          => $code,
            'redirect'      => $redirect,
        ]);
    }
}
