<?php

namespace App\Tests\SmokeScreenTests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * TODO: More of a placeholder test. Should be replaced with proper smokescreen tests.
 */
final class APIIsAliveTest extends WebTestCase
{
    public function testAPIResponds(): void
    {
        $client = self::createClient();

        $client->request('GET', '/monitoring/check_health');

        $this->assertResponseIsSuccessful();
    }
}
