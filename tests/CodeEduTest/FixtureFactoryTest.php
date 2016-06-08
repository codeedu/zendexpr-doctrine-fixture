<?php

namespace CodeEduTest;

use CodeEdu\FixtureCommand;
use CodeEdu\FixtureFactory;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Interop\Container\ContainerInterface;
use Symfony\Component\Console\Application;

class FixtureFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function test_execute()
    {
        $mockEntityManager = $this->getMockBuilder(EntityManager::class)->disableOriginalConstructor()->getMock();
        $mockContainer = $this->getMock(ContainerInterface::class);

        $mockContainer
            ->expects($this->any())
            ->method('get')
            ->willReturnCallback(function ($param) use ($mockEntityManager) {
                return $param == EntityManager::class ? $mockEntityManager : [
                    'doctrine' => [
                        'fixtures' => [
                            'MyFixtures' => __DIR__
                        ]
                    ]
                ];
            });

        $factory = new FixtureFactory();
        $command = $factory($mockContainer);
        $this->assertInstanceOf(FixtureCommand::class, $command);
    }
}