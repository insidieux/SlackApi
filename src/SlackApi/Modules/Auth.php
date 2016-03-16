<?php
namespace SlackApi\Modules;

use SlackApi\AbstractModule;

/**
 * Class Auth
 *
 * @link https://api.slack.com/methods#auth
 *
 * @package SlackApi\Modules
 */
class Auth extends AbstractModule
{
    /**
     * @link https://api.slack.com/methods/auth.test
     *
     * @return array
     */
    public function test()
    {
        return $this->get('test');
    }
}
