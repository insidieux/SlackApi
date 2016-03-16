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
     * @return array
     */
    public function getPresence($userId)
    {
        return $this->post('getPresence', ['user' => $userId]);
    }

    /**
     * @link https://api.slack.com/methods/users.info
     *
     * @param string $userId
     *
     * @return array
     */
    public function info($userId)
    {
        return $this->post('info', ['user' => $userId]);
    }

    /**
     * @link https://api.slack.com/methods/users.list
     *
     * @return array
     */
    public function getList()
    {
        return $this->post('list');
    }

    /**
     * @link https://api.slack.com/methods/users.setActive
     *
     * @return array
     */
    public function setActive()
    {
        return $this->post('setActive');
    }

    /**
     * @link https://api.slack.com/methods/users.setPresence
     *
     * @param string $presence
     *
     * @return array
     */
    public function setPresence($presence)
    {
        return $this->post('setPresence', ['presence' => $presence]);
    }
}
