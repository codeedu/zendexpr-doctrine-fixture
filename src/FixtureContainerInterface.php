<?php

namespace CodeEdu;

use Interop\Container\ContainerInterface;

interface FixtureContainerInterface
{
    public function getContainer();

    public function setContainer(ContainerInterface $container);
}