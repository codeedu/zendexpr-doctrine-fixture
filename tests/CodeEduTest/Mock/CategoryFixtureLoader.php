<?php
namespace CodeEduTest\Mock;

use CodeEdu\FixtureContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Interop\Container\ContainerInterface;

class CategoryFixtureLoader implements FixtureInterface, FixtureContainerInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName("Category Name");

        $manager->persist($category);
        $manager->flush();
    }

    public function getContainer()
    {
        return $this->container;
    }

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }
}