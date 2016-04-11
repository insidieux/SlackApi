<?php
namespace SlackApi\Models;

use SlackApi\Exceptions\AttachmentException;

/**
 * Class Attachment
 * @package SlackApi\Models
 */
class Attachment implements \JsonSerializable
{
    const COLOR_GOOD = 'good';
    const COLOR_WARNING = 'warning';
    const COLOR_DANGER = 'danger';

    /**
     * The fallback text to use for clients that don't support attachments
     *
     * @var string
     */
    protected $fallback;

    /**
     * The color to use for the attachment
     *
     * @var string
     */
    protected $color;

    /**
     * Optional text that appears above the attachment block
     *
     * @var string
     */
    protected $pretext;

    /**
     * Optional title for the attachment
     *
     * @var string
     */
    protected $title;

    /**
     * Optional text that appears within the attachment
     *
     * @var string
     */
    protected $text;

    /**
     * Optional title link for the attachment
     *
     * @var string
     */
    protected $titleLink;

    /**
     * @var string
     */
    protected $imageUrl;

    /**
     * @var string
     */
    protected $thumbUrl;

    /**
     * @var AttachmentField[]
     */
    protected $fields = [];

    /**
     * @var array
     */
    protected $markdownFields = [];

    /**
     * Attachment constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        if (isset($attributes['fallback'])) {
            $this->setFallback($attributes['fallback']);
        }
        if (isset($attributes['text'])) {
            $this->setText($attributes['text']);
        }
        if (isset($attributes['image_url'])) {
            $this->setImageUrl($attributes['image_url']);
        }
        if (isset($attributes['thumb_url'])) {
            $this->setThumbUrl($attributes['thumb_url']);
        }
        if (isset($attributes['pretext'])) {
            $this->setPretext($attributes['pretext']);
        }
        if (isset($attributes['color'])) {
            $this->setColor($attributes['color']);
        }
        if (isset($attributes['fields'])) {
            $this->setFields($attributes['fields']);
        }
        if (isset($attributes['mrkdwn_in'])) {
            $this->setMarkdownFields($attributes['mrkdwn_in']);
        }
        if (isset($attributes['title'])) {
            $this->setTitle($attributes['title']);
        }
        if (isset($attributes['title_link'])) {
            $this->setTitleLink($attributes['title_link']);
        }
    }

    /**
     * Get the fallback text
     *
     * @return string
     */
    public function getFallback()
    {
        return $this->fallback;
    }

    /**
     * Set the fallback text
     *
     * @param string $fallback
     * @return $this
     */
    public function setFallback($fallback)
    {
        $this->fallback = $fallback;

        return $this;
    }

    /**
     * Get the optional text to appear within the attachment
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the optional text to appear within the attachment
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
     * Get the optional image to appear within the attachment
     *
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * Set the optional image to appear within the attachment
     *
     * @param string $imageUrl
     * @return $this
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * Get the optional thumbnail to appear within the attachment
     *
     * @return string
     */
    public function getThumbUrl()
    {
        return $this->thumbUrl;
    }

    /**
     * Set the optional thumbnail to appear within the attachment
     *
     * @param string $thumbUrl
     * @return $this
     */
    public function setThumbUrl($thumbUrl)
    {
        $this->thumbUrl = $thumbUrl;

        return $this;
    }

    /**
     * Get the text that should appear above the formatted data
     *
     * @return string
     */
    public function getPretext()
    {
        return $this->pretext;
    }

    /**
     * Set the text that should appear above the formatted data
     *
     * @param string $pretext
     * @return $this
     */
    public function setPretext($pretext)
    {
        $this->pretext = $pretext;

        return $this;
    }

    /**
     * Get the color to use for the attachment
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set the color to use for the attachment
     *
     * @param string $color
     * @return $this
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get the title to use for the attachment
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the title to use for the attachment
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the title link to use for the attachment
     *
     * @return string
     */
    public function getTitleLink()
    {
        return $this->titleLink;
    }

    /**
     * Set the title link to use for the attachment
     *
     * @param string $titleLink
     * @return $this
     */
    public function setTitleLink($titleLink)
    {
        $this->titleLink = $titleLink;

        return $this;
    }

    /**
     * Get the fields for the attachment
     *
     * @return AttachmentField[]
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Set the fields for the attachment
     *
     * @param array $fields
     * @return $this
     */
    public function setFields(array $fields)
    {
        $this->clearFields();

        foreach ($fields as $field) {
            $this->addField($field);
        }

        return $this;
    }

    /**
     * Add a field to the attachment
     *
     * @param $field
     *
     * @return $this
     *
     * @throws AttachmentException
     */
    public function addField($field)
    {
        if ($field instanceof AttachmentField) {
            $this->fields[] = $field;

            return $this;
        } elseif (is_array($field)) {
            $this->fields[] = new AttachmentField($field);

            return $this;
        }

        throw new AttachmentException('The attachment field must be an instance ofAttachmentField or a array');
    }

    /**
     * Clear the fields for the attachment
     *
     * @return $this
     */
    public function clearFields()
    {
        $this->fields = [];

        return $this;
    }

    /**
     * Get the fields Slack should interpret in its Markdown-like language
     *
     * @return array
     */
    public function getMarkdownFields()
    {
        return $this->markdownFields;
    }

    /**
     * Set the fields Slack should interpret in its Markdown-like language
     *
     * @param array $fields
     * @return $this
     */
    public function setMarkdownFields(array $fields)
    {
        $this->markdownFields = $fields;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $options = [
            'fallback'   => $this->fallback,
            'color'      => $this->color,
            'pretext'    => $this->pretext,
            'title'      => $this->title,
            'title_link' => $this->titleLink,
            'text'       => $this->text,
            'image_url'  => $this->imageUrl,
            'thumb_url'  => $this->thumbUrl,
            'mrkdwn_in'  => $this->markdownFields
        ];

        if (!empty($this->fields)) {
            $fields = [];
            foreach ($this->fields as $field) {
                $fields[] = $field->toArray();
            }
            $options['fields'] = $fields;
        }

        return $options;
    }

    /**
     * {@inheritdoc}
     */
    function jsonSerialize()
    {
        return $this->toArray();
    }
}
