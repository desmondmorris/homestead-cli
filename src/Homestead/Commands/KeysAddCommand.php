<?php

namespace Homestead\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

class KeysAddCommand extends HomesteadCommand
{
    protected function configure()
    {
        $this
            ->setName('keys:add')
            ->setDescription('Add new private key')
            ->addArgument(
                'path',
                InputArgument::REQUIRED,
                'Key path'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $config = self::loadConfig();

        if (!isset($config['keys']) || !is_array($config['keys'])) {
          $config['keys'] = array();
        }

        $key = $input->getArgument('path');

        $config['keys'][] = $key;

        file_put_contents(
          self::getInstallPath() . "/Homestead.yaml",
          Yaml::dump($config, 3)
        );

        $output->writeln("Key added");
    }
}
