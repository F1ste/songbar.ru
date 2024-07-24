<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\SongsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ProcessingStatus;

class ProcessExcel extends Command
{
    protected $signature = 'excel:process {path} {catalog_id}';
    protected $description = 'Process Excel file in chunks';

    public function handle()
    {
        ini_set('memory_limit', '1000M'); // Увеличение лимита памяти

        $path = $this->argument('path');
        $catalogId = $this->argument('catalog_id');


        Excel::import(new SongsImport($catalogId), $path);

        // Update processing status
        $status = ProcessingStatus::where('catalog_id', $catalogId)->first();
        $status->update([
            'processed_rows' => $status->total_rows,
            'status' => 'completed'
        ]);

        $this->info('Excel file processed successfully.');
    }
}

