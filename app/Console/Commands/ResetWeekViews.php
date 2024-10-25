<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Song;
use App\Models\Catalog;

class ResetWeekViews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-week-views';

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
            $song->viewsWeekReset();
        }

        foreach ($catalogs as $catalog) {
            $catalog->viewsWeekReset();
        }
    }
}
