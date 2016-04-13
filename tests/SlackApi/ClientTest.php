<?php
namespace tests\SlackApi;

use SlackApi\Client;

/**
 * Class ClientTest
 * @package SlackApi\Test
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return string
     */
    protected function getRealToken()
    {
        return getenv('SLACK_TEST_TOKEN');
    }

    /**
     * @return string
     */
    protected function getFakeToken()
    {
        return 'fake-token';
    }

    /**
     *
     */
    public function testInstantiation()
    {
        $client = new Client($this->getRealToken());
        $this->assertInstanceOf('\SlackApi\Client', $client);
    }

    /**
     *
     */
    public function testRequestFakeToken()
    {
        $client = new Client($this->getFakeToken());

        $response = $client->request('users.list');
        $this->assertInstanceOf('\SlackApi\Response', $response);
        $this->assertTrue($response->isError());
        $this->assertEquals('invalid_auth', $response->getError());
    }

    /**
     * @expectedException \SlackApi\Exceptions\ClientException
     * @expectedExceptionMessage Expected JSON-decoded response data to be of type "array", got "NULL"
     */
    public function testRequestInvalidResponse()
    {
        $client = new Client($this->getFakeToken());
        $client->prepareResponse('failed response');
    }

    /**
     * @expectedException \SlackApi\Exceptions\ClientException
     */
    public function testRequestAPINotFoundMethod()
    {
        $client = new Client($this->getRealToken());
        $client->request('api.not-found', []);
    }

    /**
     *
     */
    public function testRegisterModule()
    {
        $client = new Client($this->getRealToken());

        $client = $client->registerModule('test', '\tests\Fixtures\TestModule');
        $this->assertInstanceOf('\SlackApi\Client', $client);
    }

    /**
     *
     */
    public function testCallRegisteredModule()
    {
        $client = new Client($this->getRealToken());
        $client = $client->registerModule('test', '\tests\Fixtures\TestModule');

        $module = $client->test();
        $this->assertInstanceOf('\tests\Fixtures\TestModule', $module);
    }

    /**
     *
     */
    public function testCallPredefinedModule()
    {
        $client = new Client($this->getRealToken());
        $this->assertInstanceOf('\SlackApi\Modules\Users', $client->users());
    }

    /**
     * @expectedException \SlackApi\Exceptions\ClientException
     * @expectedExceptionMessage Module Notfound is not registered
     */
    public function testCallNotRegisteredModule()
    {
        $client = new Client($this->getRealToken());
        $client->notFound();
    }

    /**
     * @expectedException \SlackApi\Exceptions\ClientException
     * @expectedExceptionMessage Class \tests\Fixtures\NonExists doesn't exists
     */
    public function testRegisterNonExistsModule()
    {
        $client = new Client($this->getRealToken());
        $client->registerModule('test', '\tests\Fixtures\NonExists');
    }

    /**
     * @expectedException \SlackApi\Exceptions\ClientException
     * @expectedExceptionMessage Class for module Test is not instance of AbstractModule
     */
    public function testCallRegisteredInvalidModule()
    {
        $client = new Client($this->getRealToken());
        $client = $client->registerModule('test', '\tests\Fixtures\InvalidModule');
        $client->test();
    }

    /**
     *
     */
    public function testMakeMessage()
    {
        $client = new Client($this->getRealToken());
        $message = $client->makeMessage();
        $this->assertInstanceOf('\SlackApi\Models\Message', $message);
    }

    /**
     *
     */
    public function testMakeAttachment()
    {
        $client = new Client($this->getRealToken());
        $message = $client->makeAttachment();
        $this->assertInstanceOf('\SlackApi\Models\Attachment', $message);
    }

    /**
     *
     */
    public function testMakeAttachmentField()
    {
        $client = new Client($this->getRealToken());
        $message = $client->makeAttachmentField();
        $this->assertInstanceOf('\SlackApi\Models\AttachmentField', $message);
    }
}
