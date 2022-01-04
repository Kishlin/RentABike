<?php

namespace App\Tests\FunctionalTests\Monitoring;

use App\Tests\FunctionalTests\Monitoring\Constraint\ServiceStatusIsShowingConstraint;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class CheckHealthTest extends WebTestCase
{
    public function testAPIResponse(): void
    {
        $client = self::createClient();

        $client->request('GET', '/monitoring/check_health');

        $this->assertResponseIsSuccessful();
        $this->assertResponseFormatSame('json');

        $data = json_decode($client->getResponse()->getContent(), true);

        $this->assertDataShowsStatusForService($data, 'app');
        $this->assertDataShowsStatusForService($data, 'database');
        $this->assertDataShowsStatusForService($data, 'messaging');
    }

    public static function assertDataShowsStatusForService(array $data, string $service, string $message = ''): void
    {
        self::assertThat($data, new ServiceStatusIsShowingConstraint($service), $message);
    }
}
