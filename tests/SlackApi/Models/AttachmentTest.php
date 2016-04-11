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
            'fallback'  => 'Fallback',
            'text'      => 'Text',
            'pretext'   => 'Pretext',
            'color'     => 'bad',
            'mrkdwn_in' => ['pretext', 'text', 'fields']
        ]);

        $this->assertEquals('Fallback', $attachment->getFallback());
        $this->assertEquals('Text', $attachment->getText());
        $this->assertEquals('Pretext', $attachment->getPretext());
        $this->assertEquals('bad', $attachment->getColor());
        $this->assertEquals([], $attachment->getFields());
        $this->assertEquals(['pretext', 'text', 'fields'], $attachment->getMarkdownFields());
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
        $this->assertSame('Title 1', $fields[0]->getTitle());
        $this->assertSame('Title 2', $fields[1]->getTitle());
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
        $this->assertSame($array, $attachment->toArray());
    }

    /**
     *
     */
    public function testAddFieldAsArray()
    {
        $attachment = new Attachment([
            'fallback' => 'Fallback',
            'text'     => 'Text'
        ]);

        $attachment->addField([
            'title' => 'Title 1',
            'value' => 'Value 1',
            'short' => true
        ]);

        $fields = $attachment->getFields();
        $this->assertSame(1, count($fields));
        $this->assertSame('Title 1', $fields[0]->getTitle());
    }

    /**
     *
     */
    public function testAddFieldAsObject()
    {
        $attachment = new Attachment([
            'fallback' => 'Fallback',
            'text'     => 'Text'
        ]);
        $field = new AttachmentField([
            'title' => 'Title 1',
            'value' => 'Value 1',
            'short' => true
        ]);
        $attachment->addField($field);
        $fields = $attachment->getFields();

        $this->assertSame(1, count($fields));
        $this->assertSame($field, $fields[0]);
    }

    /**
     *
     */
    public function testSetFields()
    {
        $attachment = new Attachment([
            'fallback' => 'Fallback',
            'text'     => 'Text'
        ]);

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
        $this->assertSame(2, count($attachment->getFields()));

        $attachment->setFields([]);
        $this->assertSame(0, count($attachment->getFields()));
    }
}
