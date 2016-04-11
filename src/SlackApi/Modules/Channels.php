<?php
namespace SlackApi\Modules;

use SlackApi\AbstractModule;

/**
 * Class Channels
 *
 * @link https://api.slack.com/methods#channels
 *
 * @package SlackApi\Modules
 */
class Channels extends AbstractModule
{
    /**
     * @link https://api.slack.com/methods/channels.archive
     *
     * @param string $channel
     *
     * @return \SlackApi\Response
     */
    public function archive($channel)
    {
        return $this->request('archive', ['channel' => $channel]);
    }

    /**
     * @link https://api.slack.com/methods/channels.create
     *
     * @param string $name
     *
     * @return \SlackApi\Response
     */
    public function create($name)
    {
        return $this->request('create', ['name' => $name]);
    }

    /**
     * @link https://api.slack.com/methods/channels.history
     *
     * @param string $channel
     * @param array  $options
     *
     * @return \SlackApi\Response
     */
    public function history($channel, array $options = [])
    {
        $options = array_merge(['channel' => $channel], $options);
        return $this->request('history', $options);
    }

    /**
     * @link https://api.slack.com/methods/channels.info
     *
     * @param string $channel
     *
     * @return \SlackApi\Response
     */
    public function info($channel)
    {
        return $this->request('info', ['channel' => $channel]);
    }

    /**
     * @link https://api.slack.com/methods/channels.invite
     *
     * @param string $channel
     * @param string $user
     *
     * @return \SlackApi\Response
     */
    public function invite($channel, $user)
    {
        return $this->request('invite', ['channel' => $channel, 'user' => $user]);
    }

    /**
     * @link https://api.slack.com/methods/channels.join
     *
     * @param string $channel
     *
     * @return \SlackApi\Response
     */
    public function join($channel)
    {
        return $this->request('join', ['name' => $channel]);
    }

    /**
     * @link https://api.slack.com/methods/channels.kick
     *
     * @param string $channel
     * @param string $user
     *
     * @return \SlackApi\Response
     */
    public function kick($channel, $user)
    {
        return $this->request('kick', ['channel' => $channel, 'user' => $user]);
    }

    /**
     * @link https://api.slack.com/methods/channels.leave
     *
     * @param string $channel
     *
     * @return \SlackApi\Response
     */
    public function leave($channel)
    {
        return $this->request('leave', ['channel' => $channel]);
    }

    /**
     * @link https://api.slack.com/methods/channels.list
     *
     * @param int $exclude
     *
     * @return \SlackApi\Response
     */
    public function getList($exclude = 0)
    {
        return $this->request('list', ['exclude_archived' => $exclude]);
    }

    /**
     * @link https://api.slack.com/methods/channels.mark
     *
     * @param string $channel
     * @param int    $timestamp
     *
     * @return \SlackApi\Response
     */
    public function mark($channel, $timestamp)
    {
        return $this->request('mark', ['channel' => $channel, 'ts' => $timestamp]);
    }

    /**
     * @link https://api.slack.com/methods/channels.rename
     *
     * @param string $channel
     * @param string $name
     *
     * @return \SlackApi\Response
     */
    public function rename($channel, $name)
    {
        return $this->request('rename', ['channel' => $channel, 'name' => $name]);
    }

    /**
     * @link https://api.slack.com/methods/channels.setPurpose
     *
     * @param string $channel
     * @param string $purpose
     *
     * @return \SlackApi\Response
     */
    public function setPurpose($channel, $purpose)
    {
        return $this->request('setPurpose', ['channel' => $channel, 'purpose' => $purpose]);
    }

    /**
     * @link https://api.slack.com/methods/channels.setTopic
     *
     * @param string $channel
     * @param string $topic
     *
     * @return \SlackApi\Response
     */
    public function setTopic($channel, $topic)
    {
        return $this->request('setPurpose', ['channel' => $channel, 'topic' => $topic]);
    }

    /**
     * @link https://api.slack.com/methods/channels.unarchive
     *
     * @param string $channel
     *
     * @return \SlackApi\Response
     */
    public function unArchive($channel)
    {
        return $this->request('unarchive', ['channel' => $channel]);
    }
}
