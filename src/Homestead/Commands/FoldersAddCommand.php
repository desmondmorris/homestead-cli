<?php

namespace Homestead\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

class FoldersAddCommand extends HomesteadCommand
{
    protected function configure()
    {
        $this
            ->setName('folders:add')
            ->setDescription('Add folder to sync in VM')
            ->addArgument(
                'map',
                InputArgument::REQUIRED,
                'Local directory path'
            )
            ->addArgument(
                'to',
                InputArgument::REQUIRED,
                'VM directory path'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $config = self::loadConfig();

        if (!isset($config['folders']) || !is_array($config['folders'])) {
          $config['folders'] = array();
        }

        $folder = array(
          'map' => $input->getArgument('map'),
          'to' => $input->getArgument('to')
        );

        $config['folders'][] = $folder;

        file_put_contents(
          self::getInstallPath() . "/Homestead.yaml",
          Yaml::dump($config, 3)
        );

        $output->writeln("Folders added");
    }
}
