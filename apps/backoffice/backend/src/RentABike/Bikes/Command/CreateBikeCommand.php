<?php

declare(strict_types=1);

namespace Kishlin\Apps\Backoffice\Backend\RentABike\Bikes\Command;

use Kishlin\Backend\RentABike\Bikes\Application\Create\CreateBikeCommand as ApplicationCommand;
use Kishlin\Backend\Shared\Domain\Bus\Command\CommandBus;
use Kishlin\Backend\Shared\Domain\Randomness\UuidGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CreateBikeCommand extends Command
{
    const COMMAND_NAME = 'kishlin:backoffice:bikes:create';

    const ARGUMENT_NAME = 'name';
    const ARGUMENT_TYPE = 'type';

    public function __construct(
        private CommandBus $commandBus,
        private UuidGenerator $uuidGenerator,
    ) {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName(self::COMMAND_NAME)
            ->setDescription('Adds a new bike')
            ->addArgument(self::ARGUMENT_TYPE, InputArgument::REQUIRED, 'The type of the bike.')
            ->addArgument(self::ARGUMENT_NAME, InputArgument::REQUIRED, 'The name of the bike.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $applicationCommand = ApplicationCommand::fromScalars(
            $this->uuidGenerator->uuid4(),
            $input->getArgument(self::ARGUMENT_TYPE),
            $input->getArgument(self::ARGUMENT_NAME),
        );

        $bikeId = $this->commandBus->execute($applicationCommand);

        $output->writeln('Created with id: ' . $bikeId->value());

        return Command::SUCCESS;
    }
}
