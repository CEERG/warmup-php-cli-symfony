<?php

namespace app\commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;

use app\api\BoredApi;

class GetRandomActivityCommand extends Command
{
    protected static $defaultName = 'BoredApi:GetRandomActivity';

    protected function configure()
    {
        $this->setDescription('Get a random activity');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $randomActivity = BoredApi::getRandomActivity();
        } catch (\Throwable $e) {
            $output->writeln('<error>'.$e->getMessage().'</error>');

            return Command::FAILURE;
        }

        if (empty($randomActivity)) {
            $output->writeln('<error>No activity returned</error>');

            return Command::FAILURE;
        }

        $table = new Table($output);
        
        $table
            ->setHeaders(array_keys($randomActivity))
            ->addRow($randomActivity)
        ;

        $table->render();

        return Command::SUCCESS;
    }
}