<?php

declare(strict_types=1);

namespace Kishlin\Backend\Shared\Infrastructure\Doctrine;

final class DoctrinePrefixesSearcher
{
    public static function inPath(string $path, string $mappingsPath, string $baseNamespace): array {
        $prefixes = [];

        foreach (self::modulesInPath($path) as $module) {
            $prefixes[realpath("$path/$module/$mappingsPath")] = "$baseNamespace\\$module\Domain";
        }

        return $prefixes;
    }

    private static function modulesInPath(string $path): array
    {
        return array_diff(scandir($path), ['..', '.', 'Shared']);
    }
}
