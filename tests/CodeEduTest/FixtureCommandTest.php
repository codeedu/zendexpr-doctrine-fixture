<?php

namespace CodeEduTest;

use CodeEdu\FixtureCommand;
use Doctrine\ORM\EntityManagerInterface;
use Interop\Container\ContainerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;

class FixtureCommandTest extends TestCase
{

    public function test_execute()
    {
        $mockContainer = $this->createMock(ContainerInterface::class);
        $mockEntityManager = $this->createMock(EntityManagerInterface::class);
        $application = new Application();
        $myCommand = new FixtureCommand($mockContainer);
        $myCommand->setEntityManager($mockEntityManager);
        $application->add($myCommand);


        $command = $application->find('data-fixture:import');
        $this->assertEquals('data-fixture:import', $command->getName());
    }
}