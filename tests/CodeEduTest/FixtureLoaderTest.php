<?php

namespace CodeEduTest;

use CodeEdu\FixtureLoader;
use CodeEduTest\Mock\CategoryFixtureLoader;
use Interop\Container\ContainerInterface;

class FixtureLoaderTest extends \PHPUnit_Framework_TestCase
{

    public function test_if_container_passed_to_fixture()
    {
        $mockContainer = $this->getMock(ContainerInterface::class);
        $fixture = new CategoryFixtureLoader();
        $fixtureLoader = new FixtureLoader($mockContainer);
        $fixtureLoader->addFixture($fixture);
        $this->assertInstanceOf(ContainerInterface::class, $fixture->getContainer());
    }
}