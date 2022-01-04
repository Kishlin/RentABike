<?php

namespace App\Monitoring\Controller;

use App\Monitoring\Probe\ProbeInterface;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/check_health', name: 'monitoring_status', methods: [Request::METHOD_GET])]
final class CheckHealthController
{
    public function __construct(
        private iterable $probes
    ) { }

    /**
     * @throws Exception on iterator failure.
     */
    public function __invoke(): Response
    {
        $data = [];
        foreach ($this->probes as $probe) {
            assert($probe instanceof ProbeInterface);
            $data[$probe->getName()] = $probe->isAlive() ? 'true' : 'false';
        }

        return new JsonResponse($data);
    }
}
