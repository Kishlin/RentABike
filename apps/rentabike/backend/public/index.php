<?php

use Kishlin\Apps\Rentabike\Backend\BackofficeBackendKernel;

require_once dirname(__DIR__).'/../../../vendor/autoload_runtime.php';

return function (array $context) {
    return new BackofficeBackendKernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
