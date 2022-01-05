<?php

declare(strict_types=1);

namespace Kishlin\Apps\Backoffice\Backend\Controller\Monitoring;

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
            'backoffice-backend' => true
        ];

        return new JsonResponse($data);
    }
}
