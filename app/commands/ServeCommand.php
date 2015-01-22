<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ServeCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('serve')
            ->setDescription('Use PHP\s local server')
            ->addOption('port', 'p', InputOption::VALUE_REQUIRED, 'If set, the port will be used', 8000)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
			$output->writeln("Starting server on localhost:".$input->getOption('port'));
			exec("php -S localhost:".(string)$input->getOption('port')." -t public/");
    }
}

