<?php

namespace Homestead\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SitesCommand extends HomesteadCommand
{
    protected function configure()
    {
        $this
            ->setName('sites')
            ->setDescription('List sites');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $config = self::loadConfig();

        if (!isset($config['sites']) || empty($config['sites'])) {
          $output->writeln("No sites found.");
          return;
        }

        $i = 1;
        foreach ($config['sites'] as $key => $site) {

          if (isset($site['map']) && isset($site['to'])) {
            $output->writeln($i .  ". " . $site['map'] . " (" . $site['to'] . ")");
            $i++;
          }
        }
    }
}
