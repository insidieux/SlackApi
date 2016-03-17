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
        return $this->post('getPresence', ['user' => $userId]);
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
        return $this->post('info', ['user' => $userId]);
    }

    /**
     * @link https://api.slack.com/methods/users.list
     *
     * @return \SlackApi\Response
     */
    public function getList()
    {
        return $this->post('list');
    }

    /**
     * @link https://api.slack.com/methods/users.setActive
     *
     * @return \SlackApi\Response
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
     * @return \SlackApi\Response
     */
    public function setPresence($presence)
    {
        return $this->post('setPresence', ['presence' => $presence]);
    }
}
