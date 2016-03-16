<?php
namespace tests\SlackApi;

/**
 * Class ClientTest
 * @package SlackApi\Test
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testInstantiationWithClient()
    {
        $client = new \SlackApi\Client('fake-token', new \GuzzleHttp\Client);
        $this->assertInstanceOf('\SlackApi\Client', $client);
    }

    /**
     *
     */
    public function testSetClient()
    {
        $client = new \SlackApi\Client('fake-token', new \GuzzleHttp\Client);
        $client = $client->setClient(new \GuzzleHttp\Client(['custom-param' => 'custom-value']));
        $this->assertInstanceOf('\SlackApi\Client', $client);
    }

    /**
     *
     */
    public function testRequestFakeToken()
    {
        $client = new \SlackApi\Client('fake-token', new \GuzzleHttp\Client);
        $response = $client->request('POST', 'api.test', []);
        $expect = [
            'ok'    => false,
            'error' => 'invalid_auth'
        ];
        $this->assertEquals($expect, $response);
    }

    /**
     * @expectedException \SlackApi\Exceptions\ClientException
     */
    public function testRequestAPINotFoundMethod()
    {
        $client = new \SlackApi\Client('fake-token', new \GuzzleHttp\Client);
        $client->request('POST', 'api.not-found', []);
    }

    /**
     *
     */
    public function testCallPredefinedModule()
    {
        $client = new \SlackApi\Client('fake-token', new \GuzzleHttp\Client);
        $this->assertInstanceOf('\SlackApi\Modules\Users', $client->users());
    }

    /**
     * @expectedException \SlackApi\Exceptions\ClientException
     * @expectedExceptionMessage Module Notfound is not registered
     */
    public function testCallNotRegisteredModule()
    {
        $client = new \SlackApi\Client('fake-token', new \GuzzleHttp\Client);
        $client->notFound();
    }

    /**
     *
     */
    public function testRegisterModule()
    {
        $client = new \SlackApi\Client('fake-token', new \GuzzleHttp\Client);
        $client = $client->registerModule('TestModule', \tests\Fixtures\TestModule::class);
        $this->assertInstanceOf('\SlackApi\Client', $client);
    }

    /**
     * @expectedException \SlackApi\Exceptions\ClientException
     * @expectedExceptionMessage Class \tests\Fixtures\NonExists doesn't exists
     */
    public function testRegisterNonExistsModule()
    {
        $client = new \SlackApi\Client('fake-token', new \GuzzleHttp\Client);
        $client = $client->registerModule('TestModule', '\tests\Fixtures\NonExists');
        $this->assertInstanceOf('\SlackApi\Client', $client);
    }
}