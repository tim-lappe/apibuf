<?php

namespace Apibuf\Commands;

use Apibuf\Descriptor\ProtobufDescriptorReader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GenerateControllerCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('generate:controller')
            ->setDescription('Generate a controller from a Protobuf descriptor')
            ->addOption('descriptor-file', 'd', InputOption::VALUE_OPTIONAL, 'The Protobuf descriptor file');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        error_reporting(E_ERROR);

        $io = new SymfonyStyle($input, $output);

        $io->title('Generating Controller Classes');

        $descriptorFile = $input->getOption('descriptor-file');
        if (!$descriptorFile) {
            $descriptorFile = $io->ask('Enter the path to the Protobuf descriptor file');
        }

        $protoDescriptorReader = new ProtobufDescriptorReader();
        $protoDescriptorReader->read($descriptorFile);

        return Command::SUCCESS;
    }
}