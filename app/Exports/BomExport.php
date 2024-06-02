<?php

namespace App\Exports;

use App\Models\Bom;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BomExport implements FromCollection, WithHeadings 
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Bom::select('serial', 'asset_name', 'condition', 'status', 'note',)->get();
    }

    public function headings(): array
    {
        return['serial', 'asset_name', 'condition', 'status', 'note'];
    }
}
