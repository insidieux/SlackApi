<?php
namespace tests\Fixtures;

use SlackApi\Modules\AbstractModule;

/**
 * Class TestModule
 * @package tests\Fixtures
 */
class TestModule extends AbstractModule
{
    /**
     *
     */
    public function correctMethod()
    {
        $this->post(__METHOD__);
    }
}