<?php
namespace SlackApi\Modules;

use SlackApi\AbstractModule;

/**
 * Class Files
 *
 * @link https://api.slack.com/methods#files
 * @link https://api.slack.com/methods#files.comments
 *
 * @package SlackApi\Modules
 */
class Files extends AbstractModule
{
    /**
     * @link https://api.slack.com/methods/files.delete
     *
     * @param string $file
     *
     * @return \SlackApi\Response
     */
    public function delete($file)
    {
        $this->post('delete', ['file' => $file]);
    }

    /**
     * @link https://api.slack.com/methods/files.info
     *
     * @param string $file
     * @param int    $count
     * @param int    $page
     *
     * @return \SlackApi\Response
     */
    public function info($file, $count = 100, $page = 1)
    {
        $this->post('info', ['file' => $file, 'count' => $count, 'page' => $page]);
    }

    /**
     * @link https://api.slack.com/methods/files.list
     *
     * @param array $options - see optional parameters in documentation
     *
     * @return \SlackApi\Response
     */
    public function getList(array $options = [])
    {
        $this->post('list', $options);
    }

    /**
     * @link https://api.slack.com/methods/files.revokePublicURL
     *
     * @param string $file
     *
     * @return \SlackApi\Response
     */
    public function revokePublicURL($file)
    {
        $this->post('revokePublicURL', ['file' => $file]);
    }

    /**
     * @link https://api.slack.com/methods/files.sharedPublicURL
     *
     * @param string $file
     *
     * @return \SlackApi\Response
     */
    public function sharedPublicURL($file)
    {
        $this->post('sharedPublicURL', ['file' => $file]);
    }

    /**
     * @link https://api.slack.com/methods/files.upload
     *
     * @param array $options - see optional parameters in documentation
     *
     * @return \SlackApi\Response
     */
    public function upload(array $options = [])
    {
        $this->post('upload', $options);
    }

    /**
     * @link https://api.slack.com/methods/files.comments.add
     *
     * @param string $file
     * @param string $comment
     *
     * @return \SlackApi\Response
     */
    public function commentsAdd($file, $comment)
    {
        $this->post('comments.add', ['file' => $file, 'comment' => $comment]);
    }

    /**
     * @link https://api.slack.com/methods/files.comments.delete
     *
     * @param string $file
     * @param int    $id
     *
     * @return \SlackApi\Response
     */
    public function commentsDelete($file, $id)
    {
        $this->post('comments.delete', ['file' => $file, 'id' => $id]);
    }

    /**
     * @link https://api.slack.com/methods/files.comments.edit
     *
     * @param string $file
     * @param int    $id
     * @param string $text
     *
     * @return \SlackApi\Response
     */
    public function commentsEdit($file, $id, $text)
    {
        $this->post('comments.edit', ['file' => $file, 'id' => $id, 'text' => $text]);
    }
}
