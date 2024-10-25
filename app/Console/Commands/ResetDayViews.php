<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Song;
use App\Models\Catalog;

class ResetDayViews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-day-views';

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
            $song->viewsDayReset();
        }

        foreach ($catalogs as $catalog) {
            $catalog->viewsDayReset();
        }
    }
}
