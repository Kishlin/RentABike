<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\Apps\AbstractFunctionalTests\Controller\Monitoring;

use Kishlin\Tests\Backend\Apps\AbstractFunctionalTests\Controller\Monitoring\Constraint\ServiceStatusIsShowingConstraint;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class CheckHealthControllerTestCase extends WebTestCase
{
    /**
     * @param string[] $services
     */
    protected function assertTheAPIShowsStatusForAllServices(
        KernelBrowser $client,
        string $uri,
        array $services = []
    ): void {
        $client->request('GET', $uri);

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
