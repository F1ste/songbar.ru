<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Update;
use Illuminate\Support\Facades\Log;

class ProcessExcelChunk implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;
    protected $startRow;
    protected $chunkSize;

    public function __construct($filePath, $startRow, $chunkSize = 1000)
    {
        $this->filePath = $filePath;
        $this->startRow = $startRow;
        $this->chunkSize = $chunkSize;
    }

    public function handle()
    {
        $spreadsheet = IOFactory::load($this->filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $highestRow = $sheet->getHighestRow();

        $endRow = min($this->startRow + $this->chunkSize - 1, $highestRow);

        for ($row = $this->startRow; $row <= $endRow; $row++) {
            $rowData = $sheet->rangeToArray("A{$row}:Z{$row}", null, true, false);
            // Обработайте данные строки $rowData

            Log::info("Processed row: " . $row);
        }

        if ($endRow < $highestRow) {
           Update::updateOrCreate(
                ['file_path' => $this->filePath],
                ['last_processed_row' => $endRow]
            );

            ProcessExcelChunk::dispatch($this->filePath, $endRow + 1);
        } else {
            Update::where('file_path', $this->filePath)->delete();
        }
    }
}

