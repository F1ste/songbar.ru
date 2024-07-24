<?php
namespace App\Imports;

use App\Models\Song;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class SongsImport implements ToModel, WithChunkReading
{
    private $catalogId;

    public function __construct($catalogId)
    {
        $this->catalogId = $catalogId;
    }

    public function model(array $row)
    {
        return new Song([
            'title' => $row[0],
            'singer' => $row[1],
            'catalog_id' => $this->catalogId,
        ]);
    }

    public function chunkSize(): int
    {
        return 500; // Чанк размером в 500 строк
    }
}
