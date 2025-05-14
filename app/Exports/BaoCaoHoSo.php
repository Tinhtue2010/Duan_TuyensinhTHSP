<?php

namespace App\Exports;

use App\Models\HoSo;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class BaoCaoHoSo implements FromArray, WithEvents
{
    protected $tu_ngay;
    protected $den_ngay;

    public function __construct($tu_ngay, $den_ngay)
    {
        $this->tu_ngay = $tu_ngay;
        $this->den_ngay = $den_ngay;
    }
    public function array(): array
    {
        $tu_ngay = Carbon::createFromFormat('Y-m-d', $this->tu_ngay)->format('d-m-Y');
        $den_ngay = Carbon::createFromFormat('Y-m-d', $this->den_ngay)->format('d-m-Y');
        $result = [
            ['', '', '', '', ''],
            ['', '', '', '', ''],
            ['', '', '', '', '', ''],
            ['BÁO CÁO HỒ SƠ', '', '', '', '', ''],
            ["Từ $tu_ngay đến $den_ngay ", '', '', '', '', ''],
            ['', '', '', '', '', ''],
            ['', '', '', '', '', ''],
            ['STT',  'Họ và tên', 'Số căn cước', 'Số điện thoại', 'Email', 'Nơi thường trú', 'Ngày thêm'],

        ];

        $tuNgay = Carbon::parse($this->tu_ngay)->startOfDay();
        $denNgay = Carbon::parse($this->den_ngay)->endOfDay();

        $hoSos = HoSo::orderBy('created_at', 'desc')->whereBetween('created_at', [$tuNgay, $denNgay])->get();

        $stt = 1;

        foreach ($hoSos as $hoSo) {
            $result[] = [
                $stt++,
                $hoSo->ho_ten,
                $hoSo->so_cccd,
                $hoSo->so_dien_thoai,
                $hoSo->email,
                $hoSo->noi_thuong_tru,
                $hoSo->created_at->format('d-m-Y'),
            ];
        }

        return $result;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $sheet->getPageSetup()
                    ->setPaperSize(PageSetup::PAPERSIZE_A4)
                    ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE)
                    ->setFitToWidth(1)
                    ->setFitToHeight(0)
                    ->setHorizontalCentered(true)
                    ->setPrintArea('A1:G' . $sheet->getHighestRow());

                $sheet->getPageMargins()
                    ->setTop(0.5)
                    ->setRight(0.5)
                    ->setBottom(0.5)
                    ->setLeft(0.5)
                    ->setHeader(0.3)
                    ->setFooter(0.3);

                // Set font for entire sheet
                $sheet->getParent()->getDefaultStyle()->getFont()->setName('Times New Roman');

                // Auto-width columns
                foreach (['A', 'B', 'C', 'D'] as $column) {
                    $sheet->getColumnDimension($column)->setWidth(width: 10);
                }
                $sheet->getColumnDimension('A')->setWidth(width: 7); //STT
                $sheet->getColumnDimension('B')->setWidth(width: 20); //Số tờ khai
                $sheet->getColumnDimension('C')->setWidth(width: 15); //Ngày đăng ký
                $sheet->getColumnDimension('D')->setWidth(width: 15); //Chi cục
                $sheet->getColumnDimension('E')->setWidth(width: 20); //Tên DN
                $sheet->getColumnDimension('F')->setWidth(width: 25); //Tên DN
                $sheet->getColumnDimension('G')->setWidth(width: 15); //Tên DN


                $lastRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                $sheet->getStyle('A1:' . $highestColumn . $lastRow)->getAlignment()->setWrapText(true);

                // Merge cells for headers
                // $sheet->mergeCells('A1:D1'); // CỤC HẢI QUAN
                // $sheet->mergeCells('A2:D2'); // CHI CỤC
                $sheet->mergeCells('A4:G4'); // BÁO CÁO
                $sheet->mergeCells('A5:G5'); // Tính đến ngày

                // Bold and center align for headers
                $sheet->getStyle('A1:G6')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ]
                ]);
                $sheet->getStyle('A2:G6')->applyFromArray([
                    'font' => ['bold' => true]
                ]);
                $sheet->getStyle('A9:G' . $lastRow)->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ]
                ]);
                // Italic for date row
                $sheet->getStyle('A5:G5')->applyFromArray([
                    'font' => ['italic' => true, 'bold' => false],
                ]);
                // Bold and center align for table headers
                $sheet->getStyle('A8:G8')->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Add borders to the table content
                $lastRow = $sheet->getHighestRow();
                $sheet->getStyle('A8:G' . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],

                ]);
            },
        ];
    }
}
