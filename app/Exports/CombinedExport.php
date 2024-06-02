<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\AssetExport;
use App\Exports\BomExport;

class CombinedExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Assets' => new AssetExport(),
            'Bom' => new BomExport(),
        ];
    }
}