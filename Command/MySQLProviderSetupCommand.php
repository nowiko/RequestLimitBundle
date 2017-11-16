<?php

namespace NV\RequestLimitBundle\Command;

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

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $connection = $this->getContainer()->get('doctrine.orm.default_entity_manager')->getConnection();
        $connection->exec('CREATE TABLE nv_request_limit_items (
            item_key VARCHAR(30) NOT NULL  PRIMARY KEY,
            expires_at TIMESTAMP;
            ');
        $connection->close();
    }
}
