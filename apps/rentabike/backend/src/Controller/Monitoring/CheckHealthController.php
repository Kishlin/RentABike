<?php

declare(strict_types=1);

namespace Kishlin\Apps\Rentabike\Backend\Controller\Monitoring;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/check-health', name: 'monitoring_status', methods: [Request::METHOD_GET])]
final class CheckHealthController
{
    public function __invoke(): Response
    {
        $data = [
            'rentabike-backend' => true
        ];

        return new JsonResponse($data);
    }
}
