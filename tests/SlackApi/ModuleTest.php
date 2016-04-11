<?php
namespace tests\SlackApi;

use SlackApi\Client;
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
        $module = new TestModule('api', $this->getClient());

        $response = $module->request('test', ['argument' => 'value']);
        $this->assertInstanceOf('\SlackApi\Response', $response);
        $this->assertTrue($response->isSuccess());
    }

    /**
     *
     */
    public function testPredefinedRequest()
    {
        $module = new TestModule('api', $this->getClient());

        $response = $module->test();
        $this->assertInstanceOf('\SlackApi\Response', $response);
        $this->assertTrue($response->isSuccess());
    }
}
