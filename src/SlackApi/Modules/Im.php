<?php
namespace SlackApi\Modules;

use SlackApi\AbstractModule;

/**
 * Class Im
 *
 * @link https://api.slack.com/methods#im
 *
 * @package SlackApi\Modules
 */
class Im extends AbstractModule
{
    /**
     * @link https://api.slack.com/methods/im.close
     *
     * @param string $channel
     *
     * @return \SlackApi\Response
     */
    public function close($channel)
    {
        return $this->post('close', ['channel' => $channel]);
    }

    /**
     * @link https://api.slack.com/methods/im.history
     *
     * @param string $channel
     * @param array  $options
     *
     * @return \SlackApi\Response
     */
    public function history($channel, array $options = [])
    {
        $options = array_merge(['channel' => $channel], $options);
        return $this->post('history', $options);
    }

    /**
     * @link https://api.slack.com/methods/im.list
     *
     * @return \SlackApi\Response
     */
    public function getList()
    {
        return $this->post('list');
    }

    /**
     * @link https://api.slack.com/methods/im.mark
     *
     * @param string $channel
     * @param int    $timestamp
     *
     * @return \SlackApi\Response
     */
    public function mark($channel, $timestamp)
    {
        return $this->post('mark', ['channel' => $channel, 'ts' => $timestamp]);
    }

    /**
     * @link https://api.slack.com/methods/im.open
     *
     * @param string $user
     *
     * @return \SlackApi\Response
     */
    public function open($user)
    {
        return $this->post('open', ['user' => $user]);
    }
}
