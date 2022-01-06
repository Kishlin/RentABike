<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\UnitTests\Shared\Infrastructure\Symfony\Controller\Monitoring;

use Kishlin\Backend\Shared\Infrastructure\Monitoring\Probe\Probe;
use Kishlin\Backend\Shared\Infrastructure\Symfony\Controller\Monitoring\CheckHealthController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

final class CheckHealthControllerTest extends TestCase
{
    public function testCheckHealthController(): void
    {
        $data = [
            'probeOne'  => true,
            'probTwo'   => true,
            'probThree' => false,
        ];

        $probes     = array_map([$this, 'probeMock'], array_keys($data), $data);
        $controller = new class($probes) extends CheckHealthController {};
        $response   = $controller(); // Controller is an invokable.

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame($data, json_decode($response->getContent(), true));
    }

    private function probeMock(string $name, bool $isAlive): mixed
    {
        $probe = $this->createMock(Probe::class);
        $probe->expects($this->once())->method('name')->willReturn($name);
        $probe->expects($this->once())->method('isAlive')->willReturn($isAlive);

        return $probe;
    }
}
