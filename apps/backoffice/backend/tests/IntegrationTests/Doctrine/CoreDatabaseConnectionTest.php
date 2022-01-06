<?php

declare(strict_types=1);

namespace Kishlin\Tests\Apps\Backoffice\Backend\IntegrationTests\Doctrine;

use Kishlin\Tests\Backend\Apps\IntegrationTests\Doctrine\CoreDatabaseConnectionTestCase;

final class CoreDatabaseConnectionTest extends CoreDatabaseConnectionTestCase
{
    public function testDatabaseConnection(): void
    {
        $this->doTestDatabaseConnection();
    }
}
