<?php

declare(strict_types=1);

namespace Kishlin\Apps\Backoffice\Backend\Controller\Bikes;

use Kishlin\Backend\Bikes\Application\Create\CreateBikeCommand;
use Kishlin\Backend\Shared\Domain\Bus\Command\CommandBus;
use Kishlin\Backend\Shared\Domain\UuidGenerator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/create', name: 'bikes_create', methods: [Request::METHOD_GET])]
final class CreateBikeController
{
    public function __construct(
        private CommandBus $commandBus,
        private UuidGenerator $uuidGenerator,
    ) {}

    public function __invoke(): Response
    {
        $command = new CreateBikeCommand(
            $this->uuidGenerator->generate(),
            'R',
            'TCR Advanced Pro 2',
        );

        $this->commandBus->dispatch($command);

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
