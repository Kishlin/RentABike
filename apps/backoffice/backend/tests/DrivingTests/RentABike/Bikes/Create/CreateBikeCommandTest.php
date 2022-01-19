<?php

declare(strict_types=1);

namespace Kishlin\Tests\Apps\Backoffice\Backend\DrivingTests\RentABike\Bikes\Create;

use Kishlin\Apps\Backoffice\Backend\RentABike\Bikes\Command\CreateBikeCommand as CreateBikeSymfonyCommand;
use Kishlin\Backend\Shared\Domain\Bus\Command\CommandBus;
use Kishlin\Tests\Backend\Apps\DrivingTestTraits\RentABike\Bikes\CreateBike\CreateBikeDrivingTestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CreateBikeCommandTest extends KernelTestCase
{
    use CreateBikeDrivingTestCaseTrait;

    public function testItCanCreateABike(): void
    {
        $type = 'R';
        $name = 'Giant TCR Advanced Pro 2';

        $kernel      = self::bootKernel();
        $application = new Application($kernel);

        $kernel->getContainer()->set(
            CommandBus::class,
            self::getConfiguredBusMock($type, $name)
        );

        $command = $application->find(CreateBikeSymfonyCommand::COMMAND_NAME);

        $commandTester = new CommandTester($command);
        $commandTester->execute([
            CreateBikeSymfonyCommand::ARGUMENT_TYPE => $type,
            CreateBikeSymfonyCommand::ARGUMENT_NAME => $name,
        ]);

        $commandTester->assertCommandIsSuccessful();

        $output = $commandTester->getDisplay();
        self::assertStringStartsWith('Created with id:', $output);
    }
}
