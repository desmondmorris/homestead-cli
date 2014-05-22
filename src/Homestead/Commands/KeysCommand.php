<?php

namespace Homestead\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class KeysCommand extends HomesteadCommand
{
    protected function configure()
    {
        $this
            ->setName('keys')
            ->setDescription('List keys');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $config = self::loadConfig();

        if (!isset($config['keys']) || empty($config['keys'])) {
          $output->writeln("No keys found.");
          return;
        }

        foreach ($config['keys'] as $key => $path) {
          $output->writeln(($key + 1) .  ". " . $path);
        }
    }
}
