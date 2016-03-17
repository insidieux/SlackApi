<?php
namespace SlackApi\Modules;

use SlackApi\AbstractModule;

/**
 * Class Search
 *
 * @link https://api.slack.com/methods#search
 *
 * @package SlackApi\Modules
 */
class Search extends AbstractModule
{
    /**
     * @link https://api.slack.com/methods/search.all
     *
     * @param string $query
     * @param array  $options
     *
     * @return \SlackApi\Response
     */
    public function all($query, array $options = [])
    {
        $options = array_merge(['query' => $query], $options);
        return $this->post('all', $options);
    }

    /**
     * @link https://api.slack.com/methods/search.files
     *
     * @param string $query
     * @param array  $options
     *
     * @return \SlackApi\Response
     */
    public function files($query, array $options = [])
    {
        $options = array_merge(['query' => $query], $options);
        return $this->post('files', $options);
    }

    /**
     * @link https://api.slack.com/methods/search.messages
     *
     * @param string $query
     * @param array  $options
     *
     * @return \SlackApi\Response
     */
    public function messages($query, array $options = [])
    {
        $options = array_merge(['query' => $query], $options);
        return $this->post('messages', $options);
    }
}
