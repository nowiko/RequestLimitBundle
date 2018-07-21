<?php

namespace NV\RequestLimitBundle\Command;

use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MySQLProviderSetupCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('nv:request-limit:mysql-init')
            ->setDescription('Creates a table in your project database to store keys')
            ->setHelp('This command initialize MySQL provider workflow')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Connection $connection */
        $connection = $this->getContainer()->get('doctrine.orm.default_entity_manager')->getConnection();
        $connection->exec('CREATE TABLE nv_request_limit_items (
            item_key VARCHAR(30) PRIMARY KEY,
            expires_at TIMESTAMP
            );');
        $connection->close();
    }
}
