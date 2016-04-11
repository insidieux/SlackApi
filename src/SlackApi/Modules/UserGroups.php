<?php
namespace SlackApi\Modules;

use SlackApi\AbstractModule;

/**
 * Class UserGroups
 *
 * @link https://api.slack.com/methods#usergoups
 * @link https://api.slack.com/methods#usergoups.users
 *
 * @package SlackApi\Modules
 */
class UserGroups extends AbstractModule
{
    /**
     * @link https://api.slack.com/methods/usergoups.create
     *
     * @param string $name
     * @param array  $options
     *
     * @return \SlackApi\Response
     */
    public function create($name, array $options = [])
    {
        $options = array_merge(['name' => $name], $options);
        return $this->request('create', $options);
    }

    /**
     * @link https://api.slack.com/methods/usergoups.disable
     *
     * @param string $group
     * @param int    $count
     *
     * @return \SlackApi\Response
     */
    public function disable($group, $count = 0)
    {
        return $this->request('disable', ['usergroup' => $group, 'include_count' => $count]);
    }

    /**
     * @link https://api.slack.com/methods/usergoups.enable
     *
     * @param string $group
     * @param int    $count
     *
     * @return \SlackApi\Response
     */
    public function enable($group, $count = 0)
    {
        return $this->request('enable', ['usergroup' => $group, 'include_count' => $count]);
    }

    /**
     * @link https://api.slack.com/methods/usergoups.list
     *
     * @param int $disabled
     * @param int $count
     * @param int $users
     *
     * @return \SlackApi\Response
     */
    public function getList($disabled = 0, $count = 0, $users = 0)
    {
        return $this->request('list', [
            'include_disabled' => $disabled,
            'include_count'    => $count,
            'include_users'    => $users,
        ]);
    }

    /**
     * @link https://api.slack.com/methods/usergoups.update
     *
     * @param string $group
     * @param array  $options
     *
     * @return \SlackApi\Response
     */
    public function update($group, array $options = [])
    {
        $options = array_merge(['usergroup' => $group], $options);
        return $this->request('update', $options);
    }

    /**
     * @link https://api.slack.com/methods/usergoups.users.list
     *
     * @param string $group
     * @param int    $disabled
     *
     * @return \SlackApi\Response
     */
    public function usersList($group, $disabled = 0)
    {
        return $this->request('update', ['usergroup' => $group, 'include_disabled' => $disabled]);
    }

    /**
     * @link https://api.slack.com/methods/usergoups.users.update
     *
     * @param string $group
     * @param string $users
     * @param int    $count
     *
     * @return \SlackApi\Response
     */
    public function usersUpdate($group, $users, $count = 0)
    {
        return $this->request('update', ['usergroup' => $group, 'users' => $users, 'include_count' => $count]);
    }
}
