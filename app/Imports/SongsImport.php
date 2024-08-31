<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Models\Song;

class SongsImport implements ToModel, WithChunkReading
{
    protected $catalogId;

    public function __construct($catalogId)
    {
        $this->catalogId = $catalogId;
    }

    public function model(array $row)
    {
        $title = $row[1];
        $singer = $row[2];

        $existingSong = Song::where('title', $title)
            ->where('singer', $singer)
            ->where('catalog_id', $this->catalogId)
            ->first();

        if (!$existingSong) {
            return new Song([
                'catalog_id' => $this->catalogId,
                'title' => $title,
                'singer' => $singer,
            ]);
        }

        return null;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}

