<?php
namespace tests\Fixtures;

use SlackApi\AbstractModule;

/**
 * Class TestModule
 * @package tests\Fixtures
 */
class TestModule extends AbstractModule
{
    /**
     * @return \SlackApi\Response
     */
    public function test()
    {
        return $this->post('test');
    }
}
