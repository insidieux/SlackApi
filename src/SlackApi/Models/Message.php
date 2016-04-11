<?php
namespace SlackApi\Models;

use SlackApi\Client;

/**
 * Class Message
 * @package SlackApi\Models
 */
class Message
{
    const PARSE_FULL = 'full';
    const PARSE_NONE = 'none';

    const LINK_NAMES_DISABLED = 0;
    const LINK_NAMES_ENABLED = 1;

    /**
     * Reference to the Slack client responsible for sending the message
     *
     * @var \SlackApi\Client
     */
    protected $client;

    /**
     * The text to send with the message
     *
     * @var string
     */
    protected $text;

    /**
     * The channel the message should be sent to
     *
     * @var string
     */
    protected $channel;

    /**
     * Bot's user name. Must be used in conjunction with as_user set to false, otherwise ignored
     *
     * @var string
     */
    protected $username;

    /**
     * Flag to post the message as the authored user, instead of as a bot
     *
     * @var bool
     */
    protected $sendAsUser = false;

    /**
     * URL to an image to use as the icon for this message
     *
     * @var string
     */
    protected $iconUrl;

    /**
     * Markdown support for current message
     *
     * @var bool
     */
    protected $markdown = false;

    /**
     * An array of attachments to send
     *
     * @var Attachment[]
     */
    protected $attachments = [];

    /**
     * Message constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Send the message
     *
     * @return \SlackApi\Response
     */
    public function send()
    {
        return $this->client->chat()->postMessage($this->channel, $this->text, $this->makeOptions());
    }

    /**
     * @return array
     */
    public function makeOptions()
    {
        $options = [
            'username' => $this->username,
            'as_user'  => $this->sendAsUser,
            'mrkdwn'   => $this->markdown
        ];
        if (!empty($this->attachments)) {
            $options['attachments'] = json_encode($this->attachments);
        }
        if ($this->iconUrl) {
            $options['icon_url'] = $this->iconUrl;
        }

        return $options;
    }

    /**
     * Set the message text
     *
     * @param string $text
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->text = (string)$text;

        return $this;
    }

    /**
     * Set the channel we will post to
     *
     * @param string $channel
     *
     * @return $this
     */
    public function setChannel($channel)
    {
        $this->channel = (string)$channel;

        return $this;
    }

    /**
     * Set your bot's user name
     *
     * @param string $username
     *
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = (string)$username;

        return $this;
    }

    /**
     * Set your bot's user name
     *
     * @param string $iconUrl
     *
     * @return $this
     */
    public function setIconUrl($iconUrl)
    {
        $this->iconUrl = (string)$iconUrl;

        return $this;
    }

    /**
     * Enable post message as the authed user
     *
     * @return $this
     */
    public function enableAsUser()
    {
        $this->sendAsUser = true;

        return $this;
    }

    /**
     * Disable post message as the authed user
     *
     * @return $this
     */
    public function disableAsUser()
    {
        $this->sendAsUser = false;

        return $this;
    }

    /**
     * Enable markdown support for message
     *
     * @return $this
     */
    public function enableMarkdown()
    {
        $this->markdown = true;

        return $this;
    }

    /**
     * Disable markdown support for message
     *
     * @return $this
     */
    public function disableMarkdown()
    {
        $this->markdown = false;

        return $this;
    }
}
