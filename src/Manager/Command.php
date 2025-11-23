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

    public string $version = '';

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
     * @var string[]
     */
    protected array $strings = [
        'class',
        'email',
        'license',
        'module',
        'namespace',
        'organization',
        'package',
        'packagist',
        'type',
        'package-version',
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

        foreach ($this->strings as $key) {
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
        $command = sprintf('artisan %1$s %2$s', $this->command, $this->class);

        foreach ($this->strings as $key) {
            if ($key === 'class') {
                continue;
            }
            if (! empty($this->{$key}) && is_string($this->{$key})) {
                $command .= sprintf(' --%1$s "%2$s"', $key, $this->{$key});
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
