<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Console\Commands;

use Illuminate\Support\Str;
use Playground\Make\Building\Concerns;
use Playground\Make\Configuration\Contracts\PrimaryConfiguration as PrimaryConfigurationContract;
use Playground\Make\Configuration\Model;
use Playground\Make\Console\Commands\GeneratorCommand;
use Playground\Make\Recipe\Building;
use Playground\Make\Recipe\Configuration\Recipe as Configuration;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputOption;

/**
 * \Playground\Make\Recipe\Console\Commands\RecipeMakeCommand
 */
#[AsCommand(name: 'playground:make:recipe')]
class RecipeMakeCommand extends GeneratorCommand
{
    // use Building\BuildController;
    use Concerns\BuildImplements;
    use Concerns\BuildUses;

    /**
     * @var class-string<Configuration>
     */
    public const CONF = Configuration::class;

    /**
     * @var PrimaryConfigurationContract&Configuration
     */
    protected PrimaryConfigurationContract $c;

    const SEARCH = [
        'docs' => '',
        // 'base_docs' => 'welcome',
        'extends' => '',
        'class' => '',
        'controller' => '',
        'folder' => '',
        'namespace' => '',
        'organization' => '',
        // 'namespacedModel' => '',
        // 'NamespacedDummyUserModel' => '',
        // 'namespacedUserModel' => '',
        // 'user' => '',
        // 'model' => '',
        // 'modelVariable' => '',
        // 'model_column' => '',
        // 'model_label' => '',
        // 'model_slug_plural' => '',
        'module' => '',
        'module_slug' => '',
        'title' => '',
        'package' => '',
        'config' => '',
        // 'docs_prefix' => '',
    ];

    protected string $path_destination_folder = '';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'playground:make:recipe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a recipe';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Recipe';

    public function prepareOptions(): void
    {
        $options = $this->options();
        $setOptions = [];
        if ($this->hasOption('playground') && $this->option('playground')) {
            $setOptions['playground'] = true;
        }

        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '$this->c->type()' => $this->c->type(),
        //     '$this->options()' => $this->options(),
        // ]);

        if ($setOptions) {
            $this->c->setOptions($setOptions)->apply();
        }

        $this->saveConfiguration();

        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '$this->options()' => $this->options(),
        //     '$this->c' => $this->c,
        //     // '$this->c' => $this->c->toArray(),
        //     // '$this->searches' => $this->searches,
        //     '$setOptions' => $setOptions,
        // ]);
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->reset();

        $name = $this->getNameInput();

        $this->saveConfiguration();

        return $this->return_status;
    }

    // public function finish(): ?bool
    // {
    //     $this->saveConfiguration();

    //     // if ($this->c->test()) {
    //     //     $this->createTest();
    //     // }

    //     // $this->saveConfiguration();
    //     dd([
    //         '__METHOD__' => __METHOD__,
    //         '$this->c' => $this->c,
    //         // '$this->c' => $this->c->toArray(),
    //         '$this->searches' => $this->searches,
    //     ]);

    //     return $this->return_status;
    // }

    protected function getStub(): string
    {
        return '';
    }

    /**
     * Get the console command options.
     *
     * @return array<int, mixed>
     */
    protected function getOptions(): array
    {
        $options = parent::getOptions();

        //        $options[] = ['title', null, InputOption::VALUE_OPTIONAL, 'The title of the docs'];
        //        $options[] = ['model-package', null, InputOption::VALUE_OPTIONAL, 'The model package file for all the end points.'];
        //        $options[] = ['model-file', null, InputOption::VALUE_OPTIONAL, 'The model file for the controller end points.'];
        //        $options[] = ['model-revision-file', null, InputOption::VALUE_OPTIONAL, 'The file for the revision model.'];
        //        $options[] = ['controller-package', null, InputOption::VALUE_OPTIONAL, 'The controller package file for the collection.'];

        return $options;
    }

    protected function getConfigurationFilename(): string
    {
        return sprintf(
            'recipe.%1$s.json',
            Str::of($this->c->name())->kebab(),
        );
    }
}
