<?php

namespace App\Imports;

use App\Models\PetaKerawanan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PetaKerawananImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new PetaKerawanan([
            'jenis' => $row['jenis'],
        ]);
    }
}
