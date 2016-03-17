<?php
namespace SlackApi\Modules;

use SlackApi\AbstractModule;

/**
 * Class Team
 *
 * @link https://api.slack.com/methods#team
 *
 * @package SlackApi\Modules
 */
class Team extends AbstractModule
{
    /**
     * @link https://api.slack.com/methods/team.info
     *
     * @return \SlackApi\Response
     */
    public function info()
    {
        return $this->post('info');
    }

    /**
     * @link https://api.slack.com/methods/team.accessLogs
     *
     * @param int $count
     * @param int $page
     *
     * @return \SlackApi\Response
     */
    public function accessLogs($count = 100, $page = 1)
    {
        return $this->post('accessLogs', ['count' => $count, 'page' => $page]);
    }

    /**
     * @link https://api.slack.com/methods/team.integrationLogs
     *
     * @param array $options - see optional parameters in documentation
     *
     * @return \SlackApi\Response
     */
    public function integrationLogs(array $options = [])
    {
        return $this->post('integrationLogs', $options);
    }
}
