<?php

namespace Homestead\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class InstallCommand extends HomesteadCommand
{
    protected function configure()
    {
        $this
            ->setName('install')
            ->setDescription('Installs Homestead to home directory');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $homestead_path = self::getInstallPath();

        $output->writeln("Installing Homestead");

        if (file_exists($homestead_path)) {
          $output->writeln("Homestead already installed");
          return;
        }
        else {
          if (self::has_git()) {
            $output->writeln("Cloning into " . $homestead_path);
            exec("git clone git@github.com:laravel/homestead.git " . $homestead_path);

            $output->writeln("Adding homestead box");
            exec("vagrant box add laravel/homestead");
          }
          else {
            $output->writeln("Git is not installed");
          }

        }

    }
}
