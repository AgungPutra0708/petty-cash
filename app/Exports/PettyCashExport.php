<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PettyCashExport
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function download()
    {
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Nomor');
        $sheet->setCellValue('B1', 'Periode');
        $sheet->setCellValue('C1', 'Pembuat');
        $sheet->setCellValue('D1', 'Approver');
        $sheet->setCellValue('E1', 'Jumlah Awal');
        $sheet->setCellValue('F1', 'Pengeluaran');
        $sheet->setCellValue('G1', 'Saldo');
        $sheet->setCellValue('H1', 'Status');

        $row = 2;

        foreach ($this->data as $item) {

            $sheet->setCellValue(
                'A'.$row,
                $item->nomor_petty_cash
            );

            $sheet->setCellValue(
                'B'.$row,
                $item->bulan->format('F Y')
            );

            $sheet->setCellValue(
                'C'.$row,
                $item->creator?->name
            );

            $sheet->setCellValue(
                'D'.$row,
                $item->approver?->name
            );

            $sheet->setCellValue(
                'E'.$row,
                $item->jumlah_awal
            );

            $sheet->setCellValue(
                'F'.$row,
                $item->total_pengeluaran
            );

            $sheet->setCellValue(
                'G'.$row,
                $item->jumlah_akhir
            );

            $sheet->setCellValue(
                'H'.$row,
                $item->status
            );

            $row++;
        }

        return response()->streamDownload(
            function () use ($spreadsheet) {

                $writer = new Xlsx($spreadsheet);

                $writer->save('php://output');

            },
            'laporan-petty-cash.xlsx'
        );
    }
}