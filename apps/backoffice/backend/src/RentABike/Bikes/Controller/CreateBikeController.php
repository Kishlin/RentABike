<?php

declare(strict_types=1);

namespace Kishlin\Apps\Backoffice\Backend\RentABike\Bikes\Controller;

use Kishlin\Backend\RentABike\Bikes\Application\Create\CreateBikeCommand;
use Kishlin\Backend\Shared\Domain\Bus\Command\CommandBus;
use Kishlin\Backend\Shared\Domain\Randomness\UuidGenerator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/create', name: 'bikes_create', methods: [Request::METHOD_POST])]
final class CreateBikeController
{
    public function __construct(
        private CommandBus $commandBus,
        private UuidGenerator $uuidGenerator,
    ) {}

    public function __invoke(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $data['id'] = $this->uuidGenerator->uuid4();

        $this->commandBus->execute(CreateBikeCommand::fromRequestData($data));

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
