<?php

use Kishlin\Apps\Rentabike\Backend\RentabikeBackendKernel;

require_once dirname(__DIR__).'/../../../vendor/autoload_runtime.php';

return function (array $context) {
    return new RentabikeBackendKernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
