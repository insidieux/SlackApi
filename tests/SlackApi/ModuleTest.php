<?php

use \tests\Fixtures\TestModule;

/**
 * Class AbstractModuleTest
 */
class ModuleTest extends PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testRequest()
    {
        $module = new TestModule('api', new \SlackApi\Client($_ENV['SLACK_TEST_TOKEN'], new \GuzzleHttp\Client));

        $response = $module->request('GET', 'test');
        $this->assertArrayHasKey('ok', $response);
        $this->assertTrue($response['ok']);

        $response = $module->request('POST', 'test');
        $this->assertArrayHasKey('ok', $response);
        $this->assertTrue($response['ok']);
    }

    /**
     *
     */
    public function testGetRequest()
    {
        $module = new TestModule('api', new \SlackApi\Client($_ENV['SLACK_TEST_TOKEN'], new \GuzzleHttp\Client));

        $response = $module->get('test');
        $this->assertArrayHasKey('ok', $response);
        $this->assertTrue($response['ok']);
    }

    /**
     *
     */
    public function testPostRequest()
    {
        $module = new TestModule('api', new \SlackApi\Client($_ENV['SLACK_TEST_TOKEN'], new \GuzzleHttp\Client));

        $response = $module->post('test');
        $this->assertArrayHasKey('ok', $response);
        $this->assertTrue($response['ok']);
    }

    /**
     *
     */
    public function testPredefinedRequest()
    {
        $module = new TestModule('api', new \SlackApi\Client($_ENV['SLACK_TEST_TOKEN'], new \GuzzleHttp\Client));

        $response = $module->test();
        $this->assertArrayHasKey('ok', $response);
        $this->assertTrue($response['ok']);
    }
}
