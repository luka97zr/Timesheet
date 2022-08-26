<?php

namespace App\Services;

use App\Exports\ReportExport;
use App\Services\Interface\ExportServiceInterface;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Excel;

class PdfService implements ExportServiceInterface {

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function generate()
    {
        return $this->excel->download(new ReportExport($this->data), 'report.csv');

    }

    public function setData($data) {
        $this->data = $data;
    }
}