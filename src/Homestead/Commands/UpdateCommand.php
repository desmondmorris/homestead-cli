<?php

namespace Homestead\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateCommand extends HomesteadCommand
{
    protected function configure()
    {
        $this
            ->setName('update')
            ->setDescription('Updates Homestead installation');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $homestead_path = self::getInstallPath();

        $output->writeln("Updating Homestead");

        if (!file_exists($homestead_path)) {
          $output->writeln("Homestead not installed");
          return;
        }
        else {
          if (self::has_git()) {
            $output->writeln("Pull latest updates");
            exec("cd " . $homestead_path . " && git pull");

            $output->writeln("Updating homestead box");
            exec("vagrant box update --box laravel/homestead");
          }
          else {
            $output->writeln("Git is not installed");
          }

        }

    }
}
