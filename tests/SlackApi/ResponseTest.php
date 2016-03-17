<?php
namespace tests\SlackApi;

use SlackApi\Response;

/**
 * Class ResponseTest
 * @package tests\SlackApi
 */
class ResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $response = new Response([]);
        $this->assertEmpty($response->toArray());
    }

    /**
     *
     */
    public function testEmptyResponse()
    {
        $response = new Response([]);
        $this->assertFalse($response->getStatus());
        $this->assertFalse($response->isSuccess());
        $this->assertTrue($response->isError());
        $this->assertFalse($response->hasWarning());
        $this->assertEquals('', $response->getWarning());
        $this->assertEquals('', $response->getError());
    }

    /**
     *
     */
    public function testGetFields()
    {
        $response = new Response(['field-1' => 'value-1', 'field-2' => 'value-2']);
        $this->assertEquals(['field-1', 'field-2'], $response->getFields());
    }

    /**
     *
     */
    public function testSuccessResponse()
    {
        $response = new Response(['ok' => true]);
        $this->assertTrue($response->getStatus());
        $this->assertTrue($response->isSuccess());
        $this->assertFalse($response->isError());
    }

    /**
     *
     */
    public function testWarningResponse()
    {
        $response = new Response(['warning' => 'warning']);
        $this->assertTrue($response->hasWarning());
        $this->assertEquals('warning', $response->getWarning());
    }

    /**
     *
     */
    public function testErrorResponse()
    {
        $response = new Response(['error' => 'error']);
        $this->assertEquals('error', $response->getError());
    }

    /**
     *
     */
    public function testResponseData()
    {
        $response = new Response(['users' => [['id' => 1, 'name' => 'test']]]);
        $this->assertTrue($response->has('users'));
        $this->assertEquals([['id' => 1, 'name' => 'test']], $response->get('users', []));
    }
}
