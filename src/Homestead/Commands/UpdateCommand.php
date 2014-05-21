<?php

namespace Homestead\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('update')
            ->setDescription('Updates Homestead installation');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $home = $_SERVER['HOME'];
        $homestead_path = $home . '/' . '.homestead';

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
