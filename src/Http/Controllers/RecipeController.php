<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Playground\Make\Recipe\Configuration\Recipe;
use Playground\Make\Recipe\Http\Requests\Recipe\CommandFormRequest;
use Playground\Make\Recipe\Http\Requests\Recipe\CommandRequest;
use Playground\Make\Recipe\Http\Requests\Recipe\CopyFormRequest;
use Playground\Make\Recipe\Http\Requests\Recipe\CopyRequest;
use Playground\Make\Recipe\Http\Requests\Recipe\FormRequest;
use Playground\Make\Recipe\Http\Requests\Recipe\LoadRequest;
use Playground\Make\Recipe\Http\Requests\Recipe\SaveRequest;
use Playground\Make\Recipe\Http\Requests\Recipe\WriteRequest;
use Playground\Make\Recipe\Manager;

/**
 * \Playground\Make\Recipe\Http\Controllers\RecipeController
 */
class RecipeController extends Controller
{
    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'module_label' => 'Make',
        'module_label_plural' => 'Makes',
        'module_route' => 'playground.make.recipe',
        'module_slug' => 'make',
        'privilege' => 'playground-make-recipe',
        'view' => 'playground-make-recipe',
    ];

    /**
     * Show the command form.
     */
    public function commandForm(
        CommandFormRequest $request,
        Manager $manager,
        ?string $recipe_slug = null
    ): View|RedirectResponse {
        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $_return_url = empty($validated['_return_url']) ? route('playground.make.recipe') : $validated['_return_url'];

        $recipe = empty($recipe_slug) ? null : $manager->get($recipe_slug);

        if (empty($recipe)) {
            return response()->redirectToRoute('playground.make.recipe')->with('error', 'Recipe not found: '.$recipe_slug);
        }

        /**
         * @var array<string, string> $defaults
         */
        $defaults = config('playground-make-recipe.defaults');

        $flash = [];

        $flash['command'] = $validated['command'] ?? '';
        $flash['type'] = $validated['type'] ?? '';

        $flash['_return_url'] = $_return_url;

        foreach ($defaults as $key => $value) {
            $flash[$key] = $value;
        }

        $flash['module'] = $recipe->title() ?: $recipe->slug();
        $flash['package'] = sprintf(
            '%1$s-%2$s',
            Str::of($defaults['organization'])->slug()->toString(),
            $recipe->slug()
        );

        $flash['namespace'] = Str::of($defaults['namespace'])->finish('/'.$recipe->class())->toString();

        if ($flash['type'] === 'playground-api') {
            $flash['package'] .= '-api';
            $flash['namespace'] .= '/Api';
        } elseif ($flash['type'] === 'playground-resource') {
            $flash['package'] .= '-resource';
            $flash['namespace'] .= '/Resource';
        }

        $flash['packagist'] = sprintf(
            '%1$s/%2$s',
            $defaults['github'],
            $flash['package']
        );

        //        dd([
        //            '__METHOD__' => __METHOD__,
        //            '$validated' => $validated,
        //            '$flash' => $flash,
        //            '$recipe' => $recipe,
        //        ]);

        session()->flashInput($flash);

        $data = [
            'packageInfo' => $packageInfo,
            '_return_url' => $_return_url,
            'recipe' => $recipe,
            'recipe_slug' => $recipe_slug,
        ];

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s::recipe/command-form', $packageInfo->view());

        return view($view, $data);
    }

    /**
     * command a recipe
     */
    public function command(
        CommandRequest $request,
        Manager $manager,
        ?string $recipe_slug = null
    ): RedirectResponse {

        $recipe = empty($recipe_slug) ? null : $manager->get($recipe_slug);

        $validated = $request->validated();

        $_return_url = empty($validated['_return_url']) || ! is_string($validated['_return_url']) ? route('playground.make.recipe') : $validated['_return_url'];

        if (empty($recipe)) {
            return response()->redirectToRoute('playground.make.recipe')->with('error', 'Recipe not found: '.$recipe_slug);
        }

        $recipe->apply();

        $command = $manager->command($recipe, $validated);

        // dd([
        //    '__METHOD__' => __METHOD__,
        //    '$validated' => $validated,
        //    '$command' => $command,
        //    '$recipe' => $recipe,
        //    '$command->toString()' => $command->toString(),
        // ]);
        return response()->redirectTo($_return_url)->with(
            $command?->level() ?? 'error',
            $command?->toString() ?? 'Unable to build the command for the recipe: '.$recipe->slug(),
        );
    }

    /**
     * Copy a recipe
     */
    public function copy(
        CopyRequest $request,
        Manager $manager,
        ?string $recipe_slug = null
    ): RedirectResponse {

        $recipe = empty($recipe_slug) ? null : $manager->get($recipe_slug);

        if (empty($recipe)) {
            return response()->redirectToRoute('playground.make.recipe')->with('error', 'Recipe not found: '.$recipe_slug);
        }

        $recipe->setOptions($request->validated());

        $recipe->apply();

        $manager->save($recipe);

        return response()->redirectToRoute('playground.make.recipe.form', [
            'recipe_slug' => $recipe->slug(),
        ]);
    }

    /**
     * Show the copy form.
     */
    public function copyForm(
        CopyFormRequest $request,
        Manager $manager,
        ?string $recipe_slug = null
    ): View|RedirectResponse {
        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $_return_url = empty($validated['_return_url']) ? route('playground.make.recipe') : $validated['_return_url'];

        $recipe = empty($recipe_slug) ? null : $manager->get($recipe_slug);

        if (empty($recipe)) {
            return response()->redirectToRoute('playground.make.recipe')->with('error', 'Recipe not found: '.$recipe_slug);
        }

        $flash = $recipe->toArray();

        $flash['class'] = '';
        $flash['title'] = '';
        $flash['slug'] = '';

        $flash['_return_url'] = $_return_url;

        session()->flashInput($flash);

        $data = [
            'packageInfo' => $packageInfo,
            '_return_url' => $_return_url,
            'recipe' => $recipe,
            'recipe_slug' => $recipe_slug,
        ];

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s::recipe/copy-form', $packageInfo->view());

        return view($view, $data);
    }

    /**
     * Delete a recipe
     */
    public function delete(
        Manager $manager,
        string $recipe_slug
    ): RedirectResponse {
        $manager->delete($recipe_slug);

        return response()->redirectToRoute('playground.make.recipe');
    }

    /**
     * Show the form.
     */
    public function form(
        FormRequest $request,
        Manager $manager,
        ?string $recipe_slug = null
    ): View {
        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $_return_url = empty($validated['_return_url']) ? route('playground.make.recipe') : $validated['_return_url'];

        $recipe = empty($recipe_slug) ? null : $manager->get($recipe_slug);

        if (empty($recipe)) {
            $recipe = new Recipe;
        }

        $flash = $recipe->toArray();

        $flash['_return_url'] = $_return_url;
        // dd([
        //    '__METHOD__' => __METHOD__,
        //    '$flash' => $flash,
        //    '$recipe' => $recipe,
        // ]);
        session()->flashInput($flash);

        $data = [
            'packageInfo' => $packageInfo,
            '_return_url' => $_return_url,
            'recipe' => $recipe,
            'recipe_slug' => $recipe_slug,
        ];

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s::recipe/form', $packageInfo->view());

        return view($view, $data);
    }

    /**
     * Show the index.
     */
    public function index(Manager $manager): View
    {
        $packageInfo = $this->packageInfo();

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s::recipe/index', $packageInfo->view());

        return view($view, [
            'packageInfo' => $packageInfo,
            'recipes' => $manager->index(),
        ]);
    }

    /**
     * Load recipes
     */
    public function load(
        LoadRequest $request,
        Manager $manager,
        string $recipe_slug = ''
    ): RedirectResponse {

        $validated = $request->validated();

        [$level, $with] = $manager->load($recipe_slug);

        if (! empty($validated['_return_url']) && is_string($validated['_return_url'])) {
            return response()->redirectTo($validated['_return_url'])->with($level, $with);
        } elseif (! empty($recipe_slug)) {
            return response()->redirectToRoute(
                'playground.make.recipe.form', ['recipe_slug' => $recipe_slug]
            )->with($level, $with);
        }

        return response()->redirectToRoute('playground.make.recipe.form')->with($level, $with);
    }

    /**
     * Save a recipe
     */
    public function save(
        SaveRequest $request,
        Manager $manager,
        ?string $recipe_slug = null
    ): RedirectResponse {

        $recipe = empty($recipe_slug) ? null : $manager->get($recipe_slug);

        if (empty($recipe)) {
            $recipe = new Recipe($request->validated());
        } else {
            $recipe->setOptions($request->validated());
        }

        $recipe->apply();

        $manager->save($recipe);

        if (empty($recipe_slug)) {
            $recipe_slug = $recipe->slug();
        }

        return response()->redirectToRoute('playground.make.recipe.form', [
            'recipe_slug' => $recipe_slug,
        ]);
    }

    /**
     * Write a recipe
     */
    public function saveConfiguration(
        WriteRequest $request,
        Manager $manager,
        string $recipe_slug
    ): RedirectResponse {
        $validated = $request->validated();

        $recipe = $manager->get($recipe_slug);

        if (! empty($recipe)) {
            [$level, $with] = $manager->saveConfiguration($recipe);
        } else {
            $level = 'error';
            $with = sprintf(
                'Unable to find recipe configuration for %1$s',
                $recipe_slug,
            );
        }

        if (! empty($validated['_return_url']) && is_string($validated['_return_url'])) {
            return response()->redirectTo($validated['_return_url'])->with($level, $with);
        }

        return response()->redirectToRoute('playground.make.recipe.form', [
            'recipe_slug' => $recipe_slug,
        ])->with($level, $with);
    }

    /**
     * Write a recipe
     */
    public function saveSource(
        WriteRequest $request,
        Manager $manager,
        string $recipe_slug
    ): RedirectResponse {
        $validated = $request->validated();

        $recipe = $manager->get($recipe_slug);

        if (! empty($recipe)) {
            $path = $manager->saveSource($recipe, ! empty($validated['asPhp']));
            $with = sprintf(
                'Saved recipe configuration for %1$s at %2$s',
                $recipe_slug,
                $path,
            );
        } else {
            $with = sprintf(
                'Unable to find recipe configuration for %1$s',
                $recipe_slug,
            );
        }

        if (! empty($validated['_return_url']) && is_string($validated['_return_url'])) {
            return response()->redirectTo($validated['_return_url'])->with('info', $with);
        }

        return response()->redirectToRoute('playground.make.recipe.form', [
            'recipe_slug' => $recipe_slug,
        ])->with('info', $with);
    }
}
