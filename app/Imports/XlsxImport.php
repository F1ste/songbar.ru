<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;

class XlsxImport implements ToArray
{
    public function array(array $array)
    {
        return $array;
    }
}
