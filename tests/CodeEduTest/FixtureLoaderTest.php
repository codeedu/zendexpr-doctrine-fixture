<?php

namespace CodeEduTest;

use CodeEdu\FixtureLoader;
use CodeEduTest\Mock\CategoryFixtureLoader;
use Interop\Container\ContainerInterface;
use PHPUnit\Framework\TestCase;

class FixtureLoaderTest extends TestCase
{

    public function test_if_container_passed_to_fixture()
    {
        $mockContainer = $this->createMock(ContainerInterface::class);
        $fixture = new CategoryFixtureLoader();
        $fixtureLoader = new FixtureLoader($mockContainer);
        $fixtureLoader->addFixture($fixture);
        $this->assertInstanceOf(ContainerInterface::class, $fixture->getContainer());
    }
}