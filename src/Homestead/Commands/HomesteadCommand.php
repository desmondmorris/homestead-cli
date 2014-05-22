<?php

namespace Homestead\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

class HomesteadCommand extends Command
{
    protected static $install_dir = ".homestead";

    protected static function getInstallPath() {
        return $_SERVER['HOME'] . DIRECTORY_SEPARATOR . self::$install_dir;
    }

    protected static function loadConfig() {
      $yaml = self::getInstallPath() . '/Homestead.yaml';

      if (!file_exists($yaml)) {
        return false;
      }
      $config = Yaml::parse($yaml);
      return $config;
    }

    protected static function has_git()
    {
      exec('which git', $output);
      $git = file_exists($line = trim(current($output))) ? $line : 'git';
      unset($output);
      exec($git . ' --version', $output);
      preg_match('#^(git version)#', current($output), $matches);
      return ! empty($matches[0]) ? $git : false;
    }
}
