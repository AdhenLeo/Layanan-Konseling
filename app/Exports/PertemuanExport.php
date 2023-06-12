<?php

namespace App\Exports;

use App\Models\Pertemuan;
use Maatwebsite\Excel\Concerns\{
    FromCollection,
    WithHeadings,
    WithStyles
};
use PhpOffice\PhpSpreadsheet\Style\{
    Alignment,
    Border,
    Color,
    Fill
};
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PertemuanExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        $datas = Pertemuan::with('guru', 'user')->get();
        $data = [
            ''
        ];
        return collect([$data]);
    }

    public function headings(): array 
    {
        return [
            'Nama Murid',
            'Nama Guru',
            'Tema',
            'Tanggal Pertemuan',
            'Tempat Pertemuan',
            'Kesimpulan',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();
        $range = 'A1:' . $lastColumn . $lastRow;
    
        $sheet->getStyle($range)->applyFromArray([
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFCB0C9F'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
    
        $sheet->getStyle($range)->getAlignment()->setIndent(1);
        $sheet->getStyle($range)->getAlignment()->setWrapText(true);
        $sheet->getRowDimension(1)->setRowHeight(20);
    
        // Set column widths
        for ($column = 'A'; $column <= $lastColumn; $column++) {
            $sheet->getColumnDimension($column)->setWidth(20);
        }
    
        // Set body background to white
        $sheet->getStyle('A2:' . $lastColumn . $lastRow)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('FFFFFF');
    
        // Set heading font style to bold
        $sheet->getStyle('A1:' . $lastColumn . '1')->getFont()->setBold(true);
    
        // Set body font style to normal
        $sheet->getStyle('A2:' . $lastColumn . $lastRow)->getFont()->setBold(false);
    
        // Set heading text color to white
        $sheet->getStyle('A1:' . $lastColumn . '1')->getFont()->getColor()->setRGB('FFFFFF');
    
        // Set body alignment to center
        $sheet->getStyle('A2:' . $lastColumn . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2:' . $lastColumn . $lastRow)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
    
        return $sheet;
    }
}
