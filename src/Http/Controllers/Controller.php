<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Playground\PackageInfo;

/**
 * \Playground\Make\Recipe\Http\Controllers\Controller
 */
abstract class Controller extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;
    // use DispatchesJobs;

    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'module_label' => 'Make',
        'module_label_plural' => 'Makes',
        'module_route' => 'playground.make.recipe',
        'module_slug' => 'make',
        'privilege' => 'playground-make-recipe',
    ];

    public function packageInfo(): PackageInfo
    {
        return new PackageInfo()->setOptions($this->packageInfo);
    }
}
