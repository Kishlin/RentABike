<?php

declare(strict_types=1);

namespace Kishlin\Tests\Apps\Backoffice\Backend\DrivingTests\RentABike\Bikes\Create;

use Kishlin\Backend\Shared\Domain\Bus\Command\CommandBus;
use Kishlin\Tests\Backend\Apps\DrivingTestTraits\RentABike\Bikes\CreateBike\CreateBikeDrivingTestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CreateBikeControllerTest extends WebTestCase
{
    use CreateBikeDrivingTestCaseTrait;

    public function testItCanCreateABike(): void
    {
        $type    = 'R';
        $name    = 'Giant TCR Advanced Pro 2';
        $content = json_encode([ 'type' => $type, 'name' => $name ]) ;

        $client = self::createClient();
        $this->getContainer()->set(
            CommandBus::class,
            self::getConfiguredBusMock($type, $name)
        );

        $client->request(
            method: 'POST',
            uri: 'bikes/create',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: $content);

        self::assertResponseIsSuccessful();
        self::assertResponseStatusCodeSame(Response::HTTP_CREATED);
    }
}
