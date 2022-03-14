<?php

namespace app\commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;

use app\api\BoredApi;
use app\api\enums\PriceRange;

class GetRandomActivityWithinPriceRangeCommand extends Command
{
    protected static $defaultName = 'BoredApi:GetRandomActivityInPriceRange';

    private $minPriceKey = 'minprice';
    private $maxPriceKey = 'maxprice';

    protected function configure()
    {
        $this
            ->setDescription('Find an activity within a specified price in an inclusively constrained range')
            ->addArgument($this->minPriceKey, InputArgument::REQUIRED, 'Left side of range. Min price of an activity is '.PriceRange::min->value)
            ->addArgument($this->maxPriceKey, InputArgument::REQUIRED, 'Right side of range. Max price of an activity is '.PriceRange::max->value);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $activity = BoredApi::getRandomActivityWithinPriceRange(
                $input->getArgument($this->minPriceKey),
                $input->getArgument($this->maxPriceKey)
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