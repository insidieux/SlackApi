<?php
namespace tests\SlackApi;

use SlackApi\Client;
use SlackApi\Response;
use \tests\Fixtures\TestModule;

/**
 * Class AbstractModuleTest
 */
class ModuleTest extends \PHPUnit_Framework_TestCase
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
     * @return Client
     */
    protected function getClient()
    {
        return new Client($this->getRealToken());
    }

    /**
     *
     */
    public function testRequest()
    {
        $mock = $this->getMockBuilder(TestModule::class)
            ->setMethods(['request'])
            ->disableOriginalConstructor()
            ->getMock();
        $mock->expects($this->once())
            ->method('request')
            ->will($this->returnValue(new Response(['ok' => true])));
        /** @var TestModule $mock */
        $response = $mock->request('test');
        $this->assertInstanceOf('\SlackApi\Response', $response);
        $this->assertTrue($response->isSuccess());
    }
}
