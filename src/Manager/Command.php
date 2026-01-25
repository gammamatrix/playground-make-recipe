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

    public string $class = '';

    public string $email = '';

    public string $license = '';

    public string $module = '';

    public string $namespace = '';

    public string $organization = '';

    public string $package = '';

    public string $packagist = '';

    public string $type = '';

    public string $migration_date = '';

    public string $migration_order = '';

    public string $package_version = '';

    public bool $covers = false;

    public bool $factories = false;

    public bool $force = false;

    public bool $migrations = false;

    public bool $models = false;

    public bool $playground = false;

    public bool $skeleton = false;

    public bool $test = false;

    public string $_level = 'command';

    /**
     * @var string[]
     */
    protected array $flags = [
        'all',
        'covers',
        'factories',
        'force',
        'migrations',
        'models',
        'playground',
        'revision',
        'skeleton',
        'test',
    ];

    /**
     * @var array<string, string>
     */
    protected array $strings = [
        'class' => 'class',
        'email' => 'email',
        'license' => 'license',
        'module' => 'module',
        'namespace' => 'namespace',
        'organization' => 'organization',
        'package' => 'package',
        'packagist' => 'packagist',
        'type' => 'type',
        'package_version' => 'package-version',
        'migration_date' => 'migration-date',
        'migration_order' => 'migration-order',
    ];

    /**
     * @param  array<string, mixed>  $options
     */
    public function __construct(Recipe $recipe, array $options)
    {
        $this->recipe = $recipe;

        foreach ($this->flags as $key) {
            if (isset($options[$key])) {
                $this->{$key} = ! empty($options[$key]);
            }
        }

        foreach ($this->strings as $attribute => $option) {
            if (isset($options[$attribute])) {
                $this->{$attribute} = is_string($options[$attribute]) ? trim($options[$attribute]) : '';
            }
        }
    }

    public function level(): string
    {
        return $this->_level;
    }

    public function toString(): string
    {
        $command = sprintf('artisan %1$s %2$s', $this->command, $this->class);

        foreach ($this->strings as $attribute => $option) {
            if ($attribute === 'class') {
                continue;
            }
            if (! empty($this->{$attribute}) && is_string($this->{$attribute})) {
                $command .= sprintf(' --%1$s "%2$s"', $option, $this->{$attribute});
            }
        }

        foreach ($this->flags as $key) {
            if (! empty($this->{$key})) {
                $command .= sprintf(' --%1$s', $key);
            }
        }

        if ($this instanceof ModelCommand) {
            $command .= sprintf(' --%1$s "%2$s"', 'recipe', $this->recipe->slug());
        }

        return $command;
    }
}
