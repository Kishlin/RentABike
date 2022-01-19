<?php

declare(strict_types=1);

namespace Kishlin\Tests\Apps\Backoffice\Backend\FunctionalTests\Monitoring\Controller;

use Kishlin\Tests\Backend\Apps\AbstractFunctionalTests\Controller\Monitoring\CheckHealthControllerTestCase;

final class CheckHealthControllerControllerTest extends CheckHealthControllerTestCase
{
    public function testAPIResponse(): void
    {
        $client   = self::createClient();
        $uri      = '/monitoring/check-health';

        $services = [
            'backoffice-backend',
            'database'
        ];

        self::assertTheAPIShowsStatusForAllServices($client, $uri, $services);
    }
}
