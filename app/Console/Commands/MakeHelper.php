<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeHelper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:helper {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a helper file in app/Helpers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        $name = $this->argument('name');
        $path = app_path("Helpers/{$name}.php");

        if (File::exists($path)) {
            $this->error("Helper {$name} already exists!");
            return;
        }

        File::ensureDirectoryExists(app_path('Helpers'));

        File::put($path, "<?php\n\n// Helper: {$name}\n");

        $this->info("Helper {$name} created at app/Helpers/{$name}.php");
    }
}
