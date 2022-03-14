<?php

namespace app\commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;

use app\api\BoredApi;
use app\api\enums\EventType;

class GetRandomActivityWithTypeCommand extends Command
{
    protected static $defaultName = 'BoredApi:getRandomActivityWithType';

    private $activityTypeKey = "type";

    protected function configure()
    {
        $eventTypes = array_map(fn(EventType $eventType) => $eventType->value, EventType::cases());

        $this
            ->setDescription('Find a random activity with a given type.')
            ->addArgument($this->activityTypeKey, InputArgument::REQUIRED, 'Type of an activity. Expected types: '.implode(', ', $eventTypes))
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $activity = BoredApi::getRandomActivityWIthType(
                EventType::from($input->getArgument($this->activityTypeKey))
            );
        } catch (\Throwable $e) {
            $output->writeln('<error>'.$e->getMessage().'</error>');

            return Command::FAILURE;
        }

        if (empty($activity)) {
            $output->writeln('<error>No activity found</error>');

            return Command::FAILURE;
        }

        $table = new Table($output);
        
        $table
            ->setHeaders(array_keys($activity))
            ->addRow($activity)
        ;

        $table->render();

        return Command::SUCCESS;
    }
}