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
     * @return array
     */
    public function test()
    {
        return $this->post('test');
    }
}
