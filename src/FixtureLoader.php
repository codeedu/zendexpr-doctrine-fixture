<?php

namespace CodeEdu;

use Doctrine\Common\DataFixtures\Loader as BaseLoader;
use Interop\Container\ContainerInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;


class FixtureLoader extends BaseLoader
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    public function addFixture(FixtureInterface $fixture)
    {
        if ($fixture instanceof FixtureContainerInterface) {
            $fixture->setContainer($this->container);
        }
        parent::addFixture($fixture);
    }
}
