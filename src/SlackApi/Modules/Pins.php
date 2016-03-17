<?php
namespace SlackApi\Modules;

use SlackApi\AbstractModule;

/**
 * Class Pins
 *
 * @link https://api.slack.com/methods#pins
 *
 * @package SlackApi\Modules
 */
class Pins extends AbstractModule
{
    /**
     * @link https://api.slack.com/methods/pins.add
     *
     * @param string $channel
     * @param string $file
     * @param string $comment
     * @param int    $timestamp
     *
     * @return \SlackApi\Response
     */
    public function add($channel, $file = '', $comment = '', $timestamp = 0)
    {
        return $this->post('add', [
            'channel'      => $channel,
            'file'         => $file,
            'file_comment' => $comment,
            'timestamp'    => $timestamp,
        ]);
    }

    /**
     * @link https://api.slack.com/methods/pins.list
     *
     * @param string $channel
     *
     * @return \SlackApi\Response
     */
    public function getList($channel)
    {
        return $this->post('list', ['channel' => $channel]);
    }

    /**
     * @link https://api.slack.com/methods/pins.remove
     *
     * @param string $channel
     * @param string $file
     * @param string $comment
     * @param int    $timestamp
     *
     * @return \SlackApi\Response
     */
    public function remove($channel, $file = '', $comment = '', $timestamp = 0)
    {
        return $this->post('remove', [
            'channel'      => $channel,
            'file'         => $file,
            'file_comment' => $comment,
            'timestamp'    => $timestamp,
        ]);
    }
}
