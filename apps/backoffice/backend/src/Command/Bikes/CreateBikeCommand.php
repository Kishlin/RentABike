<?php

declare(strict_types=1);

namespace Kishlin\Apps\Backoffice\Backend\Command\Bikes;

use Kishlin\Backend\Bikes\Application\Create\CreateBikeCommand as ApplicationCommand;
use Kishlin\Backend\Shared\Domain\Bus\Command\CommandBus;
use Kishlin\Backend\Shared\Domain\UuidGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CreateBikeCommand extends Command
{
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
            ->setName('kishlin:backoffice:bike:create')
            ->setDescription('Adds a new bike')
            ->addArgument(self::ARGUMENT_TYPE, InputArgument::REQUIRED, 'The type of the bike.')
            ->addArgument(self::ARGUMENT_NAME, InputArgument::REQUIRED, 'The name of the bike.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $applicationCommand = new ApplicationCommand(
            $this->uuidGenerator->generate(),
            $input->getArgument(self::ARGUMENT_TYPE),
            $input->getArgument(self::ARGUMENT_NAME),
        );

        $this->commandBus->dispatch($applicationCommand);

        return Command::SUCCESS;
    }
}
