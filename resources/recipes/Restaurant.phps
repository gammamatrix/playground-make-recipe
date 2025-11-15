<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Models;

/**
 * \Playground\Make\Models\Recipe\Restaurant
 */
class Restaurant extends Playground
{

    public function addColumns(): void
    {
        $this->columns['price'] = [
            'description' => 'A money column.',
            'label' => 'Price',
            'index' => true,
            'nullable' => true,
            'type' => 'string',
        ];
    }


    public function init(): void
    {
        $this->addColumns();
    }
}
