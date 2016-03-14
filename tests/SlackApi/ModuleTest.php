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
    public function testInstantiation()
    {
        $module = new TestModule(new \SlackApi\Client('fake-token', new \GuzzleHttp\Client));
        $this->assertInstanceOf('\SlackApi\Client', $module->getClient());
        $this->assertEquals('testmodule', $module->getName());
    }

    /**
     *
     */
    public function testGetRequestEndPoint()
    {
        $module = new TestModule(new \SlackApi\Client('fake-token', new \GuzzleHttp\Client));
        $this->assertEquals('testmodule.method', $module->getRequestEndPoint('method'));
    }
}
