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
        $this->request('delete', ['file' => $file]);
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
        $this->request('info', ['file' => $file, 'count' => $count, 'page' => $page]);
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
        $this->request('list', $options);
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
        $this->request('revokePublicURL', ['file' => $file]);
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
        $this->request('sharedPublicURL', ['file' => $file]);
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
        $this->request('upload', $options);
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
        $this->request('comments.add', ['file' => $file, 'comment' => $comment]);
    }

    /**
     * @link https://api.slack.com/methods/files.comments.delete
     *
     * @param string $file
     * @param int    $commentId
     *
     * @return \SlackApi\Response
     */
    public function commentsDelete($file, $commentId)
    {
        $this->request('comments.delete', ['file' => $file, 'id' => $commentId]);
    }

    /**
     * @link https://api.slack.com/methods/files.comments.edit
     *
     * @param string $file
     * @param int    $commentId
     * @param string $text
     *
     * @return \SlackApi\Response
     */
    public function commentsEdit($file, $commentId, $text)
    {
        $this->request('comments.edit', ['file' => $file, 'id' => $commentId, 'text' => $text]);
    }
}
