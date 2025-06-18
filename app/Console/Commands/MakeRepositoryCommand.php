<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class MakeRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repo {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a service , repository and interface for a given model';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $model = Str::studly($name);
        $variable = lcfirst(class_basename($model));

        $filesystem = new Filesystem();

        $interfacePath = app_path("Repositories/Interfaces/{$model}RepositoryInterface.php");
        $repositoryPath = app_path("Repositories/{$model}Repository.php");

        if (!$filesystem->exists(app_path('Repositories/Interfaces'))) {
            $filesystem->makeDirectory(app_path('Repositories/Interfaces'), 0755, true);
        }

        $interfaceStub = $filesystem->get(app_path('stubs/repository.interface.stub'));
        $repositoryStub = $filesystem->get(app_path('stubs/repository.stub'));

        $interfaceContent = str_replace(
            ['{{ model }}', '{{ $variable }}'],
            [$model, '$' . $variable],
            $interfaceStub
        );

        $repositoryContent = str_replace(
            ['{{ model }}', '{{ $variable }}'],
            [$model, '$' . $variable],
            $repositoryStub
        );

        $filesystem->put($interfacePath, $interfaceContent);
        $filesystem->put($repositoryPath, $repositoryContent);

        // Service generation
        $servicePath = app_path("Services/{$model}Service.php");

        if (!$filesystem->exists(app_path('Services'))) {
            $filesystem->makeDirectory(app_path('Services'), 0755, true);
        }

        $serviceStub = $filesystem->get(app_path('stubs/service.stub'));
        $serviceContent = str_replace(
            ['{{ model }}', '{{ $variable }}'],
            [$model, '$' . $variable],
            $serviceStub
        );
        $filesystem->put($servicePath, $serviceContent);

        $this->info("Repository and interface created for model: {$model}");
        $this->info("Repository Path: {$repositoryPath}");
        $this->info("Interface Path: {$interfacePath}");
        $this->info("Service Path: {$servicePath}");
    }
}
