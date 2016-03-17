<?php
namespace tests\SlackApi;

use SlackApi\Client;
use SlackApi\Exceptions\ClientException;

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
        $client = new Client($this->getRealToken(), new \GuzzleHttp\Client);
        $this->assertInstanceOf('\SlackApi\Client', $client);
    }

    /**
     *
     */
    public function testSetClient()
    {
        $client = new Client($this->getRealToken(), new \GuzzleHttp\Client);

        $client = $client->setClient(new \GuzzleHttp\Client(['custom-param' => 'custom-value']));
        $this->assertInstanceOf('\SlackApi\Client', $client);
    }

    /**
     *
     */
    public function testRequestFakeToken()
    {
        $client = new Client($this->getFakeToken(), new \GuzzleHttp\Client);

        $response = $client->request('POST', 'users.list');
        $this->assertInstanceOf('\SlackApi\Response', $response);
        $this->assertTrue($response->isError());
        $this->assertEquals('invalid_auth', $response->getError());
    }

    /**
     * @expectedException \SlackApi\Exceptions\ClientException
     * @expectedExceptionMessage Expected JSON-decoded response data to be of type "array", got "string"
     */
    public function testRequestInvalidResponse()
    {
        $mock = $this->getMockBuilder('\SlackApi\Client')
            ->disableOriginalConstructor()
            ->getMock();

        $message = 'Expected JSON-decoded response data to be of type "array", got "%s"';
        $message = sprintf($message, 'string');
        $mock->expects($this->any())
            ->method('request')
            ->will($this->throwException(new ClientException($message)));

        /** @var Client $mock */
        $mock->request('POST', 'api.not-found', []);
    }

    /**
     * @expectedException \SlackApi\Exceptions\ClientException
     */
    public function testRequestAPINotFoundMethod()
    {
        $client = new Client($this->getRealToken(), new \GuzzleHttp\Client);
        $client->request('POST', 'api.not-found', []);
    }

    /**
     *
     */
    public function testRegisterModule()
    {
        $client = new Client($this->getRealToken(), new \GuzzleHttp\Client);

        $client = $client->registerModule('test', '\tests\Fixtures\TestModule');
        $this->assertInstanceOf('\SlackApi\Client', $client);
    }

    /**
     *
     */
    public function testCallRegisteredModule()
    {
        $client = new Client($this->getRealToken(), new \GuzzleHttp\Client);
        $client = $client->registerModule('test', '\tests\Fixtures\TestModule');

        $module = $client->test();
        $this->assertInstanceOf('\tests\Fixtures\TestModule', $module);
    }

    /**
     *
     */
    public function testCallPredefinedModule()
    {
        $client = new Client($this->getRealToken(), new \GuzzleHttp\Client);
        $this->assertInstanceOf('\SlackApi\Modules\Users', $client->users());
    }

    /**
     * @expectedException \SlackApi\Exceptions\ClientException
     * @expectedExceptionMessage Module Notfound is not registered
     */
    public function testCallNotRegisteredModule()
    {
        $client = new Client($this->getRealToken(), new \GuzzleHttp\Client);
        $client->notFound();
    }

    /**
     * @expectedException \SlackApi\Exceptions\ClientException
     * @expectedExceptionMessage Class \tests\Fixtures\NonExists doesn't exists
     */
    public function testRegisterNonExistsModule()
    {
        $client = new Client($this->getRealToken(), new \GuzzleHttp\Client);
        $client->registerModule('test', '\tests\Fixtures\NonExists');
    }

    /**
     * @expectedException \SlackApi\Exceptions\ClientException
     * @expectedExceptionMessage Class for module Test is not instance of AbstractModule
     */
    public function testCallRegisteredInvalidModule()
    {
        $client = new Client($this->getRealToken(), new \GuzzleHttp\Client);
        $client = $client->registerModule('test', '\tests\Fixtures\InvalidModule');
        $client->test();
    }
}