<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateModelCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('model:make')
            ->setDescription('Create a model and run composer dumpautoload.')
            ->addArgument('name', InputArgument::REQUIRED, 'Name of the class');
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
      $output_file_path = getcwd().DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."models".DIRECTORY_SEPARATOR.$input->getArgument('name').".php";
			$output->writeln("<info>Generating model</info>");
      $template = file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'CreateModelTemplate.txt');
      $template = str_replace('$NAME$', $input->getArgument('name'), $template);
      $output->writeln("<info>Creating model in ".$output_file_path."</info>");
      file_put_contents($output_file_path, $template);
      $output->writeln("<info>Running composer dumpautoload</info>");
      exec("composer dumpautoload");
    }
}


