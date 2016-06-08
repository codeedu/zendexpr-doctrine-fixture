<?php

namespace CodeEduTest;

use CodeEdu\FixtureCommand;
use Doctrine\ORM\EntityManagerInterface;
use Interop\Container\ContainerInterface;
use Symfony\Component\Console\Application;

class FixtureCommandTest extends \PHPUnit_Framework_TestCase
{

    public function test_execute()
    {
        $mockContainer = $this->getMock(ContainerInterface::class);
        $mockEntityManager = $this->getMock(EntityManagerInterface::class);
        $application = new Application();
        $myCommand = new FixtureCommand($mockContainer);
        $myCommand->setEntityManager($mockEntityManager);
        $application->add($myCommand);


        $command = $application->find('data-fixture:import');
        $this->assertEquals('data-fixture:import', $command->getName());
    }
}