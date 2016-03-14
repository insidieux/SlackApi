<?php
namespace SlackApi\Modules;

/**
 * Class Users
 * @package SlackApi\Requests
 */
class Users extends AbstractModule
{
    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getList()
    {
        return $this->post('list');
    }
}
