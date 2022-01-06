<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\Apps\FunctionalTests\Controller\Monitoring;

use Kishlin\Tests\Backend\PHPUnit\Monitoring\Constraint\ServiceStatusIsShowingConstraint;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class CheckHealthTestCase extends WebTestCase
{
    /**
     * @param string[] $services
     */
    protected function doTestAPIResponse(array $services): void
    {
        $client = self::createClient();

        $client->request('GET', '/monitoring/check-health');

        $this->assertResponseIsSuccessful();
        $this->assertResponseFormatSame('json');

        $data = json_decode($client->getResponse()->getContent(), true);

        foreach ($services as $service) {
            $this->assertDataShowsStatusForService($data, $service);
        }
    }

    public static function assertDataShowsStatusForService(array $data, string $service, string $message = ''): void
    {
        self::assertThat($data, new ServiceStatusIsShowingConstraint($service), $message);
    }
}
