<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Configuration\Concerns;

/**
 * \Playground\Make\Recipe\Configuration\Concerns\Flavors
 */
trait Flavors
{
    /**
     * @var string[]
     */
    protected array $flavors = [];

    public function addFlavor(string $flavor): self
    {
        throw_if(empty($flavor), 'InvalidArgumentException', '$flavor is not allowed to be empty.');

        if (! in_array($flavor, $this->flavors, true)) {
            $this->flavors[] = $flavor;
        }

        return $this;
    }

    public function removeFlavor(string $flavor): self
    {
        throw_if(empty($flavor), 'InvalidArgumentException', '$flavor is not allowed to be empty.');

        $this->flavors = array_filter($this->flavors, function ($value) use ($flavor) {
            return $flavor !== $value;
        });

        return $this;
    }

    /**
     * @param  array<mixed>  $flavors
     */
    public function addFlavors(array $flavors): self
    {
        foreach ($flavors as $flavor) {
            if (is_string($flavor)) {
                $this->addFlavor($flavor);
            }
        }

        return $this;
    }

    /**
     * @return string[]
     */
    public function flavors(): array
    {
        return $this->flavors;
    }
}
