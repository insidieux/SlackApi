<?php
namespace SlackApi\Modules;

use SlackApi\AbstractModule;

/**
 * Class Dnd
 *
 * @link https://api.slack.com/methods#dnd
 *
 * @package SlackApi\Modules
 */
class Dnd extends AbstractModule
{
    /**
     * @link https://api.slack.com/methods/dnd.endDnd
     *
     * @return \SlackApi\Response
     */
    public function endDnd()
    {
        return $this->post('endDnd');
    }

    /**
     * @link https://api.slack.com/methods/dnd.endSnooze
     *
     * @return \SlackApi\Response
     */
    public function endSnooze()
    {
        return $this->post('endSnooze');
    }

    /**
     * @link https://api.slack.com/methods/dnd.info
     *
     * @param string $user
     *
     * @return \SlackApi\Response
     */
    public function info($user)
    {
        return $this->post('info', ['user' => $user]);
    }

    /**
     * @link https://api.slack.com/methods/dnd.setSnooze
     *
     * @param int $minutes
     *
     * @return \SlackApi\Response
     */
    public function setSnooze($minutes)
    {
        return $this->post('setSnooze', ['user' => $minutes]);
    }
}

