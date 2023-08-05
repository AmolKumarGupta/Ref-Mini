<?php

namespace App\Console\Commands;

use App\Models\Menu;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RefminiInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refmini:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'used to setup refmini';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Migrating tables...');
        Artisan::call('migrate');

        $menu = Menu::first();
        if ($menu) {
            $this->info('Menu already seeded, ignoring seeds...');
            $this->warn('Run seeds manually if something is missing');
        }else {
            $this->info('Running seeds...');
            Artisan::call('db:seed');
        }
        
        $this->newLine();
        $this->info('Done. You can login using');
        $this->info('email: admin@gmail.com');
        $this->info('password: admin');

        return 0;
    }
}
