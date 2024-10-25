<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Song;
use App\Models\ProcessingStatus;

class ProcessExcelChunk implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;
    protected int $catalogId;
    protected $startRow;
    protected $chunkSize;

    public function __construct($filePath, int $catalogId, $startRow = 1, $chunkSize = 1000)
    {
        $this->filePath = $filePath;
        $this->catalogId = $catalogId;
        $this->startRow = $startRow;
        $this->chunkSize = $chunkSize;
    }

    public function handle()
    {
        $spreadsheet = IOFactory::load($this->filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $highestRow = $sheet->getHighestRow();
    
        $endRow = min($this->startRow + $this->chunkSize - 1, $highestRow);
    
        ProcessingStatus::updateOrCreate(
            ['catalog_id' => $this->catalogId],
            [
                'total_rows' => $highestRow,
                'processed_rows' => $endRow,
                'status' => $endRow < $highestRow ? 'in_progress' : 'completed'
            ]
        );
    
        for ($row = $this->startRow; $row <= $endRow; $row++) {
            $rowData = $sheet->rangeToArray("A{$row}:C{$row}", null, true, false);
            foreach ($rowData as $data) {
                $title = $data[1] ?? null;
                $singer = $data[2] ?? null;
    
                if (!empty($title) && !empty($singer)) {
                    $song = Song::where('title', $title)
                        ->where('singer', $singer)
                        ->first();
    
                    if (!$song) {
                        $song = Song::create([
                            'title' => $title,
                            'singer' => $singer,
                        ]);                        
                    }
                    $song->catalogs()->syncWithoutDetaching($this->catalogId);
                }
            }
        }
    
        if ($endRow < $highestRow) {
            ProcessExcelChunk::dispatch($this->filePath, $this->catalogId, $endRow + 1);
        }
    }
    
}
