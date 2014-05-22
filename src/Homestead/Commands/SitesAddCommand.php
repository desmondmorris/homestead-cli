<?php

namespace Homestead\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

class SitesAddCommand extends HomesteadCommand
{
    protected function configure()
    {
        $this
            ->setName('sites:add')
            ->setDescription('Add new site in Homestead environment')
            ->addArgument(
                'hostname',
                InputArgument::REQUIRED,
                'Site hostname'
            )
            ->addArgument(
                'webroot',
                InputArgument::REQUIRED,
                'Webroot directory path'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $config = self::loadConfig();

        if (!isset($config['sites']) || !is_array($config['sites'])) {
          $config['sites'] = array();
        }

        $site = array(
          'map' => $input->getArgument('hostname'),
          'to' => $input->getArgument('webroot')
        );

        $config['sites'][] = $site;

        file_put_contents(
          self::getInstallPath() . "/Homestead.yaml",
          Yaml::dump($config, 3)
        );

        $output->writeln("Site added");
    }
}
