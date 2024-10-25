<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Song;
use App\Models\Catalog;

class ResetMonthViews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-month-views';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $songs = Song::all();
        $catalogs = Catalog::all();

        foreach ($songs as $song) {
            $song->viewsMonthReset();
        }

        foreach ($catalogs as $catalog) {
            $catalog->viewsMonthReset();
        }
    }
}
