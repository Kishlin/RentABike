<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\IsolatedTests\Shared\Infrastructure\Monitoring\Controller\Symfony;

use Kishlin\Backend\Shared\Infrastructure\Monitoring\Controller\Symfony\AbstractCheckHealthController;
use Kishlin\Backend\Shared\Infrastructure\Monitoring\Probe\Probe;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

final class AbstractCheckHealthControllerTest extends TestCase
{
    public function testCheckHealthController(): void
    {
        $probesData = [
            'probeOne'  => true,
            'probTwo'   => true,
            'probThree' => false,
        ];

        $controller = $this->controller($probesData);
        $response   = $controller(); // Controller is an invokable.

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame($probesData, json_decode($response->getContent(), true));
    }

    private function controller(array $probesData): AbstractCheckHealthController
    {
        $probes = array_map([$this, 'probeMock'], array_keys($probesData), $probesData);

        return new class($probes) extends AbstractCheckHealthController {};
    }

    private function probeMock(string $name, bool $isAlive): mixed
    {
        $probe = $this->createMock(Probe::class);
        $probe->expects($this->once())->method('name')->willReturn($name);
        $probe->expects($this->once())->method('isAlive')->willReturn($isAlive);

        return $probe;
    }
}
