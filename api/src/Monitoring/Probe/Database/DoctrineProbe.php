<?php

namespace App\Monitoring\Probe\Database;

use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineProbe implements DatabaseProbeInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    )
    { }

    public function isAlive(): bool
    {
        $connection = $this->entityManager->getConnection();

        try {
            $connection->connect();
        } catch (Exception $e) {
            return false;
        }

        return $connection->isConnected();
    }
}
