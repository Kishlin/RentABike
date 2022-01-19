<?php

declare(strict_types=1);

namespace Kishlin\Apps\Backoffice\Backend\Monitoring\Controller;

use Kishlin\Backend\Shared\Infrastructure\Monitoring\Controller\Symfony\AbstractCheckHealthController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/check-health', name: 'monitoring_status', methods: [Request::METHOD_GET])]
final class CheckHealthController extends AbstractCheckHealthController
{
}
