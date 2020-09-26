<?php

declare(strict_types=1);

$directory = __DIR__.'/../generated/Tracking';

return [
    'openapi-file' => __DIR__.'/../resources/tracking.json',
    'namespace' => 'Ups\Api\Tracking',
    'directory' => $directory,
    'reference' => true,
    'strict' => false,
    'clean-generated' => true,
    'use-fixer' => true,
    'fixer-config-file' => __DIR__.'/../.php_cs',
];
