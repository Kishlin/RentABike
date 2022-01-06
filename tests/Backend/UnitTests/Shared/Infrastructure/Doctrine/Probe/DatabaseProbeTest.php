<?php

declare(strict_types=1);

namespace Kishlin\Tests\Backend\UnitTests\Shared\Infrastructure\Doctrine\Probe;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Kishlin\Backend\Shared\Infrastructure\Doctrine\Probe\DatabaseProbe;
use Kishlin\Backend\Shared\Infrastructure\Monitoring\Probe\Probe;
use Kishlin\Tests\Backend\PHPUnit\Monitoring\Constraint\ProbeIsAliveConstraint;
use Kishlin\Tests\Backend\PHPUnit\Monitoring\Constraint\ProbeIsDeadConstraint;
use PHPUnit\Framework\TestCase;

final class DatabaseProbeTest extends TestCase
{
    public function testIsNotAliveWhenNotGivenAnEntityManager(): void
    {
        $probe = new DatabaseProbe(null);

        $this->assertProbeIsDead($probe);
    }

    public function testIsNotAliveWhenConnectionFails(): void
    {
        $probe = new DatabaseProbe($this->buildEntityManagerStub(isConnected: false));

        $this->assertProbeIsDead($probe);
    }

    public function testIsAliveWhenConnectionWorks(): void
    {
        $probe = new DatabaseProbe($this->buildEntityManagerStub(isConnected: true));

        $this->assertProbeIsAlive($probe);
    }

    public static function assertProbeIsAlive(Probe $probe, string $message = ''): void
    {
        self::assertThat($probe->isAlive(), new ProbeIsAliveConstraint($probe->name()), $message);
    }

    public static function assertProbeIsDead(Probe $probe, string $message = ''): void
    {
        self::assertThat($probe->isAlive(), new ProbeIsDeadConstraint($probe->name()), $message);
    }

    private function buildEntityManagerStub(bool $isConnected): mixed
    {
        $connection = $this->createMock(Connection::class);
        $connection->method('isConnected')->willReturn($isConnected);

        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->method('getConnection')->willReturn($connection);
        return $entityManager;
    }
}
