<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Manager;

use Playground\Make\Recipe\Configuration\Recipe;

/**
 * \Playground\Make\Recipe\Manager\Command
 */
abstract class Command
{
    protected Recipe $recipe;

    public string $command = 'playground:make';

    public string $email = '';

    public string $license = '';

    public string $module = '';

    public string $namespace = '';

    public string $organization = '';

    public string $package = '';

    public string $packagist = '';

    public string $type = '';

    public string $version = '';

    public string $_level = 'info';

    /**
     * @param  array<string, mixed>  $options
     */
    public function __construct(Recipe $recipe, array $options)
    {
        $this->recipe = $recipe;

        $strings = [
            'email',
            'license',
            'module',
            'namespace',
            'organization',
            'package',
            'packagist',
            'type',
            'version',
        ];
        foreach ($strings as $key) {
            if (isset($options[$key])) {
                $this->{$key} = is_string($options[$key]) ? trim($options[$key]) : '';
            }
        }
    }

    public function level(): string
    {
        return $this->_level;
    }

    public function toString(): string
    {
        $command = sprintf('artisan %1$s', $this->command);

        $strings = [
            'email',
            'license',
            'module',
            'namespace',
            'organization',
            'package',
            'packagist',
            'type',
            'version',
        ];

        foreach ($strings as $key) {
            if (! empty($this->{$key})) {
                $command .= sprintf(' --%1$s "%2$s"', $key, $this->{$key});
            }
        }

        return $command;
    }
}
