<?php

declare(strict_types=1);

namespace Kishlin\Apps\Rentabike\Backend\Controller\Monitoring;

use Kishlin\Backend\Shared\Infrastructure\Symfony\Controller\Monitoring\CheckHealthController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/check-health', name: 'monitoring_status', methods: [Request::METHOD_GET])]
final class CheckHealthController extends BaseController
{
}
