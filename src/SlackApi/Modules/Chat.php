<?php
namespace SlackApi\Modules;

use SlackApi\AbstractModule;

/**
 * Class Chat
 *
 * @link https://api.slack.com/methods#chat
 *
 * @package SlackApi\Modules
 */
class Chat extends AbstractModule
{
    /**
     * @link https://api.slack.com/methods/chat.delete
     *
     * @param int    $timestamp
     * @param string $channel
     *
     * @return \SlackApi\Response
     */
    public function delete($timestamp, $channel)
    {
        return $this->post('delete', ['ts' => $timestamp, 'channel' => $channel]);
    }

    /**
     * @link https://api.slack.com/methods/chat.postMessage
     *
     * @param string $channel
     * @param string $text
     * @param array  $options - see optional parameters
     *
     * @return \SlackApi\Response
     */
    public function postMessage($channel, $text, array $options = [])
    {
        $options = array_merge(['channel' => $channel, 'text' => $text], $options);
        return $this->post('postMessage', $options);
    }

    /**
     * @link https://api.slack.com/methods/chat.update
     *
     * @param int    $timestamp
     * @param string $channel
     * @param string $text
     * @param array  $options - see optional parameters in documentation
     *
     * @return \SlackApi\Response
     */
    public function update($timestamp, $channel, $text, array $options = [])
    {
        $options = array_merge(['ts' => $timestamp, 'channel' => $channel, 'text' => $text], $options);
        return $this->post('update', $options);
    }
}
