<?php
namespace SlackApi\Modules;

use SlackApi\AbstractModule;

/**
 * Class Api
 *
 * @link https://api.slack.com/methods#api
 *
 * @package SlackApi\Modules
 */
class Api extends AbstractModule
{
    /**
     * @link https://api.slack.com/methods/api.test
     *
     * @return array
     */
    public function test()
    {
        return $this->get('test');
    }
}
