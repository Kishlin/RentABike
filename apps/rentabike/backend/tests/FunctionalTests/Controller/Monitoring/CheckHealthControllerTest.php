<?php

declare(strict_types=1);

namespace Kishlin\Tests\Apps\Rentabike\Backend\FunctionalTests\Controller\Monitoring;

use Kishlin\Tests\Backend\Apps\FunctionalTests\Controller\Monitoring\CheckHealthTestCase;

final class CheckHealthControllerTest extends CheckHealthTestCase
{
    public function testAPIResponse(): void
    {
        $this->doTestAPIResponse([
            'rentabike-backend',
            'database'
        ]);
    }
}
