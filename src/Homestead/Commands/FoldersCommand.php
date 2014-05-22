<?php

namespace Homestead\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FoldersCommand extends HomesteadCommand
{
    protected function configure()
    {
        $this
            ->setName('folders')
            ->setDescription('List folders');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $config = self::loadConfig();

        if (!isset($config['folders']) || empty($config['folders'])) {
          $output->writeln("No folders found.");
          return;
        }

        $i = 1;
        foreach ($config['folders'] as $key => $folder) {

          if (isset($folder['map']) && isset($folder['to'])) {
            $output->writeln($i .  ". " . $folder['map'] . " (" . $folder['to'] . ")");
            $i++;
          }
        }
    }
}
