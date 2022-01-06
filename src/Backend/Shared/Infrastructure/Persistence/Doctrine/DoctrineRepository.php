<?php

declare(strict_types=1);

namespace Kishlin\Backend\Shared\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Kishlin\Backend\Shared\Domain\Aggregate\AggregateRoot;

abstract class DoctrineRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    protected function persist(AggregateRoot $entity): void
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush($entity);
    }
}
