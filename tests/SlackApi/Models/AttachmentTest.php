<?php
namespace tests\SlackApi\Models;

use SlackApi\Models\Attachment;
use SlackApi\Models\AttachmentField;

/**
 * Class AttachmentTest
 * @package tests\SlackApi\Models
 */
class AttachmentTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testInstantiationFromArray()
    {
        $attachment = new Attachment([
            'fallback'   => 'Fallback',
            'text'       => 'Text',
            'image_url'  => 'Image url',
            'thumb_url'  => 'Thumb url',
            'pretext'    => 'Pretext',
            'color'      => 'bad',
            'mrkdwn_in'  => ['pretext', 'text', 'fields'],
            'title'      => 'Title',
            'title_link' => 'Title link',
        ]);

        $this->assertEquals('Fallback', $attachment->getFallback());
        $this->assertEquals('Text', $attachment->getText());
        $this->assertEquals('Image url', $attachment->getImageUrl());
        $this->assertEquals('Thumb url', $attachment->getThumbUrl());
        $this->assertEquals('Pretext', $attachment->getPretext());
        $this->assertEquals('bad', $attachment->getColor());
        $this->assertEquals([], $attachment->getFields());
        $this->assertEquals(['pretext', 'text', 'fields'], $attachment->getMarkdownFields());
        $this->assertEquals('Title', $attachment->getTitle());
        $this->assertEquals('Title link', $attachment->getTitleLink());
    }

    /**
     *
     */
    public function testInstantiationFromArrayWithFields()
    {
        $attachment = new Attachment([
            'fallback'  => 'Fallback',
            'text'      => 'Text',
            'pretext'   => 'Pretext',
            'color'     => 'bad',
            'mrkdwn_in' => [],
            'fields'    => [
                [
                    'title' => 'Title 1',
                    'value' => 'Value 1',
                    'short' => false
                ],
                [
                    'title' => 'Title 2',
                    'value' => 'Value 1',
                    'short' => false
                ]
            ]
        ]);

        $fields = $attachment->getFields();
        $this->assertEquals('Title 1', $fields[0]->getTitle());
        $this->assertEquals('Title 2', $fields[1]->getTitle());
    }

    /**
     *
     */
    public function testAttachmentToArray()
    {
        $array = [
            'fallback'   => 'Fallback',
            'text'       => 'Text',
            'pretext'    => 'Pretext',
            'color'      => 'bad',
            'mrkdwn_in'  => ['pretext', 'text'],
            'image_url'  => 'http://fake.host/image.png',
            'thumb_url'  => 'http://fake.host/image.png',
            'title'      => 'A title',
            'title_link' => 'http://fake.host/',
            'fields'     => [
                [
                    'title' => 'Title 1',
                    'value' => 'Value 1',
                    'short' => false
                ],
                [
                    'title' => 'Title 2',
                    'value' => 'Value 1',
                    'short' => false
                ]
            ]
        ];

        $attachment = new Attachment($array);
        $this->assertEquals($array, $attachment->toArray());
    }


    /**
     * @expectedException \SlackApi\Exceptions\AttachmentException
     * @expectedExceptionMessage Attachment field must be an instance of AttachmentField or a keyed array
     */
    public function testAttachBadArguments()
    {
        $attachment = new Attachment;
        $attachment->addField('Some bad argument');
    }

    /**
     *
     */
    public function testAddFieldAsArray()
    {
        $attachment = new Attachment;
        $attachment->addField([
            'title' => 'Title 1',
            'value' => 'Value 1',
            'short' => true
        ]);

        $fields = $attachment->getFields();
        $this->assertEquals(1, count($fields));
        $this->assertEquals('Title 1', $fields[0]->getTitle());
    }

    /**
     *
     */
    public function testAddFieldAsObject()
    {
        $attachment = new Attachment;
        $field = new AttachmentField([
            'title' => 'Title 1',
            'value' => 'Value 1',
            'short' => true
        ]);
        $attachment->addField($field);

        $fields = $attachment->getFields();
        $this->assertEquals(1, count($fields));
        $this->assertEquals($field, $fields[0]);
    }

    /**
     *
     */
    public function testSetFields()
    {
        $attachment = new Attachment;
        $attachment->addField([
            'title' => 'Title 1',
            'value' => 'Value 1',
            'short' => true
        ]);
        $attachment->addField([
            'title' => 'Title 2',
            'value' => 'Value 2',
            'short' => true
        ]);

        $this->assertEquals(2, count($attachment->getFields()));

        $attachment->setFields([]);
        $this->assertEquals(0, count($attachment->getFields()));
    }

    /**
     *
     */
    public function testJsonSerialize()
    {
        $options = [
            'fallback'   => 'Fallback',
            'text'       => 'Text',
            'pretext'    => 'Pretext',
            'color'      => 'bad',
            'mrkdwn_in'  => ['pretext', 'text', 'fields'],
            'image_url'  => 'Image url',
            'thumb_url'  => 'Thumb url',
            'title'      => 'Title',
            'title_link' => 'Title link',
        ];

        $attachment = new Attachment($options);
        $this->assertEquals($options, $attachment->toArray());
        $this->assertEquals(json_encode($options), json_encode($attachment));
    }
}
