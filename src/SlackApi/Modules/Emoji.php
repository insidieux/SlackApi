<?php
namespace SlackApi\Modules;

use SlackApi\AbstractModule;

/**
 * Class Emoji
 *
 * @link https://api.slack.com/methods#emoji
 *
 * @package SlackApi\Modules
 */
class Emoji extends AbstractModule
{
    /**
     * @link https://api.slack.com/methods/emoji.list
     *
     * @return \SlackApi\Response
     */
    public function getList()
    {
        return $this->request('list');
    }
}
