<?php

namespace App\Exports;

use App\Models\Asset;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AssetExport implements FromCollection, WithHeadings 
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Asset::select('id', 'name', 'type', 'specification')->get();
    }

    public function headings(): array
    {
        return['id', 'name', 'type', 'specification'];
    }
}
