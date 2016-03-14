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
        $this->assertEquals('fake-token', $client->getToken());
        $this->assertInstanceOf('\GuzzleHttp\Client', $client->getClient());
    }

    /**
     *
     */
    public function testSetToken()
    {
        $client = new \SlackApi\Client('fake-token', new \GuzzleHttp\Client);
        $client->setToken('another-fake-token');
        $this->assertEquals('another-fake-token', $client->getToken());
    }

    /**
     *
     */
    public function testSetClient()
    {
        $client = new \SlackApi\Client('fake-token', new \GuzzleHttp\Client);
        $client->setClient(new \GuzzleHttp\Client(['custom-param' => 'custom-value']));
        $this->assertInstanceOf('\GuzzleHttp\Client', $client->getClient());
        $this->assertEquals('custom-value', $client->getClient()->getConfig('custom-param'));
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
     * @expectedExceptionMessage Client error: `POST https://slack.com/api/api.not-found` resulted in a `404 Not Found` response:
     */
    public function testRequestAPINotFoundMethod()
    {
        $client = new \SlackApi\Client('fake-token', new \GuzzleHttp\Client);
        $client->request('POST', 'api.not-found', []);
    }

    /**
     * @expectedException \SlackApi\Exceptions\ClientException
     * @expectedExceptionMessage Invalid API module NotFound called, class could not be found
     */
    public function testCallNotFoundModule()
    {
        $client = new \SlackApi\Client('fake-token', new \GuzzleHttp\Client);
        $client->notFound();
    }

    /**
     *
     */
    public function testCallPredefinedMethod()
    {
        $client = new \SlackApi\Client('fake-token', new \GuzzleHttp\Client);
        $this->assertInstanceOf('\SlackApi\Modules\Users', $client->users());
    }
}