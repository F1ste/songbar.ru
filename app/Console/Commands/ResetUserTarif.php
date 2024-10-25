<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ResetUserTarif extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-user-tarif';

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
        $users = User::all();
        
        foreach ($users as $user) {
            $tarifs = $user->tarifs;

            foreach ($tarifs as $tarif) {
                if ($tarif->tarif_end == Carbon::now()) {
                    $user->removeRole($tarif->tarif_name);
                }
            }
        }
    }
}
