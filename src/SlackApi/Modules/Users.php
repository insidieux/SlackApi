<?php
namespace SlackApi\Modules;

use SlackApi\AbstractModule;

/**
 * Class Users
 *
 * @link https://api.slack.com/methods#users
 *
 * @package SlackApi\Modules
 */
class Users extends AbstractModule
{
    /**
     * @link https://api.slack.com/methods/users.getPresence
     *
     * @param string $userId
     *
     * @return \SlackApi\Response
     */
    public function getPresence($userId)
    {
        return $this->request('getPresence', ['user' => $userId]);
    }

    /**
     * @link https://api.slack.com/methods/users.info
     *
     * @param string $userId
     *
     * @return \SlackApi\Response
     */
    public function info($userId)
    {
        return $this->request('info', ['user' => $userId]);
    }

    /**
     * @link https://api.slack.com/methods/users.list
     *
     * @param array $attributes
     *
     * @return \SlackApi\Response
     */
    public function getList($attributes = [])
    {
        return $this->request('list', $attributes);
    }

    /**
     * @link https://api.slack.com/methods/users.setActive
     *
     * @return \SlackApi\Response
     */
    public function setActive()
    {
        return $this->request('setActive');
    }

    /**
     * @link https://api.slack.com/methods/users.setPresence
     *
     * @param string $presence
     *
     * @return \SlackApi\Response
     */
    public function setPresence($presence)
    {
        return $this->request('setPresence', ['presence' => $presence]);
    }
}
