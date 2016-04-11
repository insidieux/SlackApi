<?php
namespace tests\SlackApi\Models;

use SlackApi\Client;
use SlackApi\Models\Attachment;
use SlackApi\Models\Message;

/**
 * Class MessageTest
 * @package tests\SlackApi\Models
 */
class MessageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return string
     */
    protected function getRealToken()
    {
        return getenv('SLACK_TEST_TOKEN');
    }

    /**
     * @return Message
     */
    protected function getMessage()
    {
        return new Message(new Client($this->getRealToken()));
    }

    /**
     *
     */
    public function testInstantiation()
    {
        $this->assertInstanceOf('SlackApi\Models\Message', $this->getMessage());
    }

    /**
     *
     */
    public function testSetText()
    {
        $message = $this->getMessage();

        $message->setText('Hello world');
        $this->assertSame('Hello world', $message->getText());
    }

    /**
     *
     */
    public function testSetChannelWithTo()
    {
        $message = $this->getMessage();

        $message->to('#channel');
        $this->assertSame('#channel', $message->getChannel());
    }

    /**
     *
     */
    public function testSetChannelWithSetter()
    {
        $message = $this->getMessage();

        $message->setChannel('#channel');
        $this->assertSame('#channel', $message->getChannel());
    }

    /**
     *
     */
    public function testSetUsernameWithFrom()
    {
        $message = $this->getMessage();

        $message->from('username');
        $this->assertSame('username', $message->getUsername());
    }

    /**
     *
     */
    public function testSetUsernameWithSetter()
    {
        $message = $this->getMessage();

        $message->setUsername('username');
        $this->assertSame('username', $message->getUsername());
    }

    /**
     *
     */
    public function testAttachWithArray()
    {
        $message = $this->getMessage();

        $attachment = [
            'fallback' => 'Fallback text for IRC',
            'text'     => 'Attachment text',
            'pretext'  => 'Attachment pretext',
            'color'    => 'bad',
            'fields'   => []
        ];
        $message->attach($attachment);

        $attachments = $message->getAttachments();
        $this->assertEquals(1, count($attachments));

        /** @var Attachment $object */
        $object = $attachments[0];

        $this->assertEquals($attachment['fallback'], $object->getFallback());
        $this->assertEquals($attachment['text'], $object->getText());
        $this->assertEquals($attachment['pretext'], $object->getPretext());
        $this->assertEquals($attachment['color'], $object->getColor());
    }

    /**
     * @throws \SlackApi\Exceptions\MessageException
     */
    public function testAttachWithObject()
    {
        $message = $this->getMessage();

        $attachment = new Attachment([
            'fallback' => 'Fallback text for IRC',
            'text'     => 'Text'
        ]);
        $message->attach($attachment);

        $attachments = $message->getAttachments();
        $this->assertEquals(1, count($attachments));
        $this->assertEquals($attachment, $attachments[0]);
    }

    /**
     *
     */
    public function testMultipleAttachments()
    {
        $message = $this->getMessage();
        $object1 = new Attachment([
            'fallback' => 'Fallback text for IRC',
            'text'     => 'Text'
        ]);
        $object2 = new Attachment([
            'fallback' => 'Fallback text for IRC',
            'text'     => 'Text'
        ]);

        $message->attach($object1)->attach($object2);

        $attachments = $message->getAttachments();
        $this->assertEquals(2, count($attachments));
        $this->assertEquals($object1, $attachments[0]);
        $this->assertEquals($object2, $attachments[1]);
    }

    /**
     *
     */
    public function testSetAttachmentsWipesExistingAttachments()
    {
        $message = $this->getMessage();
        $object1 = new Attachment([
            'fallback' => 'Fallback text for IRC',
            'text'     => 'Text'
        ]);
        $object2 = new Attachment([
            'fallback' => 'Fallback text for IRC',
            'text'     => 'Text'
        ]);
        $message->attach($object1)->attach($object2);

        $this->assertEquals(2, count($message->getAttachments()));
        $message->setAttachments([['fallback' => 'a', 'text' => 'b']]);
        $this->assertEquals(1, count($message->getAttachments()));
        $this->assertEquals('a', $message->getAttachments()[0]->getFallback());
    }
}
