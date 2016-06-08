<?php

namespace CodeEdu;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

class FixtureFactory
{
    function __invoke(ContainerInterface $container)
    {
        $paths = $this->getOptions($container, 'fixtures');
        $em = $container->get(EntityManager::class);
        $importCommand = new FixtureCommand($container);
        $importCommand->setEntityManager($em);
        $importCommand->setPath($paths);

        return $importCommand;
    }


    public function getOptions(ContainerInterface $container, $key)
    {
        $options = $container->get('config');
        if (!isset($options['doctrine'][$key])) {
            return array();
        }

        return $options['doctrine'][$key];
    }
}
