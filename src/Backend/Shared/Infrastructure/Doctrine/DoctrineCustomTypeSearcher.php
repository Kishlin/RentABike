<?php

declare(strict_types=1);

namespace Kishlin\Backend\Shared\Infrastructure\Doctrine;

use Kishlin\Backend\Shared\Domain\Tools;

final class DoctrineCustomTypeSearcher
{
    public static function inPath(string $path, string $typesPath, string $baseNamespace): array
    {
        $prefixes = [];

        foreach (self::modulesInPath($path) as $module) {
            foreach(scandir("$path/$module/$typesPath") as $file) {
                if (false === Tools::endsWith($file, 'Type.php')) {
                    continue;
                }

                $prefixes[] = str_replace(['/', '.php'], ['\\', ''], "$baseNamespace/$module/$typesPath/$file");
            }
        }

        return $prefixes;
    }

    private static function modulesInPath(string $path): array
    {
        return array_diff(scandir($path), ['..', '.', 'Shared']);
    }
}
