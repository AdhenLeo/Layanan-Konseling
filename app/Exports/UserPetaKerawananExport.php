<?php

namespace App\Exports;

use App\Models\UserPetaKerawanan;
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

class UserPetaKerawananExport implements FromCollection, WithHeadings, WithStyles
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        $datas = getSiswaPetakerawanan($this->id);
        $data = [];
        foreach ($datas as $siswa) {
            $petakerawanans = UserPetaKerawanan::with('user', 'peta_kerawanan')->where('user_id', $siswa->id)->get();
            $datapeta = [];
            foreach ($petakerawanans as $i => $peta) {
                $datapeta[] = $peta->peta_kerawanan->jenis;
            }

            $data[] = [
                'NIPD' => $siswa->nip,
                'Nama Murid' => $siswa->nama,
                'Sering sakit' => in_array('Sering sakit', $datapeta) ? '√' : '',
                'Sering ijin' => in_array('Sering ijin', $datapeta) ? '√' : '',
                'Sering alpha' => in_array('Sering alpha', $datapeta) ? '√' : '',
                'Sering terlambat' => in_array('Sering terlambat', $datapeta) ? '√' : '',
                'Bolos' => in_array('Bolos', $datapeta) ? '√' : '',
                'Kelainan jasmani' => in_array('Kelainan jasmani', $datapeta) ? '√' : '',
                'Minat/ motivasi belajar kurang' => in_array('Minat/ motivasi belajar kurang', $datapeta) ? '√' : '',
                'Introvert / pendiam' => in_array('Introvert / pendiam', $datapeta) ? '√' : '',
                'Tinggal dengan wali' => in_array('Tinggal dengan wali', $datapeta) ? '√' : '',
                'Kemampuan kurang' => in_array('Kemampuan kurang', $datapeta) ? '√' : '',
                'Berkelahi' => in_array('Berkelahi', $datapeta) ? '√' : '',
                'Menentang guru' => in_array('Menentang guru', $datapeta) ? '√' : '',
                'Mengganggu teman' => in_array('Mengganggu teman', $datapeta) ? '√' : '',
                'Pacaran' => in_array('Pacaran', $datapeta) ? '√' : '',
                'Broken home' => in_array('Broken home', $datapeta) ? '√' : '',
                'Kondisi ekonomi kurang' => in_array('Kondisi ekonomi kurang', $datapeta) ? '√' : '',
                'Pergaulan di luar sekolah' => in_array('Pergaulan di luar sekolah', $datapeta) ? '√' : '',
                'Pengguna narkoba' => in_array('Pengguna narkoba', $datapeta) ? '√' : '',
                'Merokok' => in_array('Merokok', $datapeta) ? '√' : '',
                'Membiayai sekolah sendiri / bekerja' => in_array('Membiayai sekolah sendiri / bekerja', $datapeta) ? '√' : '',
                'Kesimpulan' => $siswa->ket
            ];
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'NIPD',
            'Nama Murid',
            'Sering sakit',
            'Sering ijin',
            'Sering alpha',
            'Sering terlambat',
            'Bolos',
            'Kelainan jasmani',
            'Minat/ motivasi belajar kurang',
            'Introvert / pendiam',
            'Tinggal dengan wali',
            'Kemampuan kurang',
            'Berkelahi',
            'Menentang guru',
            'Mengganggu teman',
            'Pacaran',
            'Broken home',
            'Kondisi ekonomi kurang',
            'Pergaulan di luar sekolah',
            'Pengguna narkoba',
            'Merokok',
            'Membiayai sekolah sendiri / bekerja',
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
                'startColor' => ['rgb' => '4267AD'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
    
        $sheet->getStyle($range)->getAlignment()->setIndent(1);
        $sheet->getStyle($range)->getAlignment()->setWrapText(true);
        $sheet->getRowDimension(1)->setRowHeight(34);
    
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
