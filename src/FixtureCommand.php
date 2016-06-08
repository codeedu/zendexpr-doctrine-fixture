<?php

namespace CodeEdu;

use Interop\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;

class FixtureCommand extends Command
{
    protected $paths;

    protected $em;

    /**
     * @var ContainerInterface
     */
    protected $container;

    const PURGE_MODE_TRUNCATE = 2;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        parent::__construct();
    }

    protected function configure()
    {
        parent::configure();

        $this->setName('data-fixture:import')
            ->setDescription('Import Data Fixtures')
            ->setHelp(
                <<<EOT
                The import command Imports data-fixtures
EOT
            )
            ->addOption('append', null, InputOption::VALUE_NONE, 'Append data to existing data.')
            ->addOption('purge-with-truncate', null, InputOption::VALUE_NONE, 'Truncate tables before inserting data');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $loader = new FixtureLoader($this->container);
        $purger = new ORMPurger();

        if ($input->getOption('purge-with-truncate')) {
            $purger->setPurgeMode(self::PURGE_MODE_TRUNCATE);
        }

        $executor = new ORMExecutor($this->em, $purger);

        foreach ($this->paths as $key => $value) {
            $loader->loadFromDirectory($value);
        }
        $executor->execute($loader->getFixtures(), $input->getOption('append'));
        $output->writeln("<info>Fixtures loaded!!</info>");
    }

    public function setPath($paths)
    {
        $this->paths=$paths;
    }

    public function setEntityManager($em)
    {
        $this->em = $em;
    }
}
