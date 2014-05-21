<?php

namespace Homestead\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class InstallCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('install')
            ->setDescription('Installs Homestead to home directory');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $home = $_SERVER['HOME'];
        $homestead_path = $home . '/' . '.homestead';

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

    private static function has_git()
  	{
  		exec('which git', $output);
  		$git = file_exists($line = trim(current($output))) ? $line : 'git';
  		unset($output);
  		exec($git . ' --version', $output);
  		preg_match('#^(git version)#', current($output), $matches);
  		return ! empty($matches[0]) ? $git : false;
  	}
}
