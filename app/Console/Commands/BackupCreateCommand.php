<?php

namespace App\Console\Commands;

use App\Library\Backup\Create;
use App\Library\Backup\Zip;
use Illuminate\Console\Command;

class BackupCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create backup';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Start creating backup');
        $create = app(Create::class);
        $this->info('Start dumping databases');
        $create->dumpDatabase();
        $files = $create->collectFiles();

        $this->info('Creating zip archive and moving to destinations');
        $zip = app(Zip::class);
        $zip
            ->create()
            ->addFiles($files)
            ->sendToDestinations()
            ->delete();

        $this->output->success('Creating backup is successful');
    }
}
