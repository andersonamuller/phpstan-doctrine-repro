<?php

declare(strict_types=1);

use App\Kernel;

require __DIR__ . '/vendor/autoload_runtime.php';

return static fn() => new Kernel('dev', true);
