<?php
namespace SlackApi\Models;

use SlackApi\Client;
use SlackApi\Exceptions\MessageException;

/**
 * Class Message
 * @package SlackApi\Models
 */
class Message
{
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
     * The username the message should be sent as
     *
     * @var string
     */
    protected $username;

    /**
     * Flag to post the message as the authored user, instead of as a bot
     *
     * @var bool
     */
    protected $asUser = false;

    /**
     * Whether the message text should be interpreted in Slack's Markdown-like language
     *
     * @var boolean
     */
    protected $markdown = true;

    /**
     * An array of attachments to send
     *
     * @var array
     */
    protected $attachments = [];

    /**
     * Message constructor
     *
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
        return $this->client->chat()->postMessage($this->getChannel(), $this->getText(), $this->makeOptions());
    }

    /**
     * @return array
     */
    public function makeOptions()
    {
        $options = [
            'username'    => $this->getUsername(),
            'as_user'     => $this->getAsUser(),
            'mrkdwn'      => $this->isMarkdown(),
            'attachments' => json_encode($this->getAttachments())
        ];
        return $options;
    }

    /**
     * Get the message text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the message text
     *
     * @param string $text
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Get the channel we will post to
     *
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Set the channel we will post to
     *
     * @param string $channel
     * @return $this
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;
        return $this;
    }

    /**
     * Get the username we will post as
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the username we will post as
     *
     * @param string $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get flag to post the message as the authored user, instead of as a bot
     *
     * @return string
     */
    public function getAsUser()
    {
        return $this->asUser;
    }

    /**
     * Set flag to post the message as the authored user, instead of as a bot
     *
     * @param bool $value
     *
     * @return $this
     */
    public function setAsUser($value)
    {
        $this->asUser = (bool)$value;
        return $this;
    }

    /**
     * Enable posting the message as the authored user, instead of as a bot
     *
     * @return $this
     */
    public function enableAsUser()
    {
        $this->setAsUser(true);
        return $this;
    }

    /**
     * Disable posting the message as the authored user, instead of as a bot
     *
     * @return $this
     */
    public function disableAsUser()
    {
        $this->setAsUser(false);
        return $this;
    }

    /**
     * Get whether message text should be formatted with Slack's Markdown-like language
     *
     * @return boolean
     */
    public function isMarkdown()
    {
        return $this->markdown;
    }

    /**
     * Set whether message text should be formatted with Slack's Markdown-like language
     *
     * @param boolean $value
     * @return $this
     */
    public function setMarkdown($value)
    {
        $this->markdown = (bool)$value;
        return $this;
    }

    /**
     * Enable Markdown formatting for the message
     *
     * @return $this
     */
    public function enableMarkdown()
    {
        $this->setMarkdown(true);
        return $this;
    }

    /**
     * Disable Markdown formatting for the message
     *
     * @return $this
     */
    public function disableMarkdown()
    {
        $this->setMarkdown(false);
        return $this;
    }

    /**
     * Change the name of the user the post will be made as
     *
     * @param string $username
     *
     * @return $this
     */
    public function from($username)
    {
        $this->setUsername($username);
        return $this;
    }

    /**
     * Change the channel the post will be made to
     *
     * @param string $channel
     *
     * @return $this
     */
    public function toChannel($channel)
    {
        $this->setChannel('#' . $channel);
        return $this;
    }

    /**
     * Change the channel the post will be made to
     *
     * @param string $user
     *
     * @return $this
     */
    public function toUser($user)
    {
        $this->setChannel('@' . $user);
        return $this;
    }

    /**
     * Add an attachment to the message
     *
     * @param array|Attachment $attachment
     *
     * @return $this
     *
     * @throws MessageException
     */
    public function attach($attachment)
    {
        if ($attachment instanceof Attachment) {
            $this->attachments[] = $attachment;
            return $this;
        } elseif (is_array($attachment)) {
            $attachmentObject = new Attachment($attachment);
            $this->attachments[] = $attachmentObject;
            return $this;
        }
        throw new MessageException('Attachment must be an instance of Attachment or a keyed array');
    }

    /**
     * Get the attachments for the message
     *
     * @return Attachment[]
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * Set the attachments for the message
     *
     * @param array $attachments
     *
     * @return $this
     */
    public function setAttachments(array $attachments)
    {
        $this->clearAttachments();
        foreach ($attachments as $attachment) {
            $this->attach($attachment);
        }
        return $this;
    }

    /**
     * Remove all attachments for the message
     *
     * @return $this
     */
    public function clearAttachments()
    {
        $this->attachments = [];
        return $this;
    }
}
