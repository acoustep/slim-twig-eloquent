<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class NewCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('new')
            ->setDescription('Create a fresh copy of Slim Eloquent Twig.')
            ->addArgument('name', InputArgument::REQUIRED, 'Name of the directory')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
				$package_directory = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..';
				$project_directory = getcwd().DIRECTORY_SEPARATOR.$name;
				$output->writeln('Copying files from '.$package_directory);
				$this->recurse_copy($package_directory, $project_directory);
				$output->writeln('Files copied to '.$project_directory);
    }

	// Thanks to http://php.net/manual/en/function.copy.php#91010
	protected function recurse_copy($src,$dst,$ignore_directories = ['vendor', 'node_modules']) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                $this->recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
	} 
}


