<?php

namespace App\Services;

use App\Exports\ReportExport;
use App\Services\Interface\ExportServiceInterface;
use Maatwebsite\Excel\Excel;

class ExcelService implements ExportServiceInterface {
    private $data;
    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function generate()
    {
        return $this->excel->store(new ReportExport($this->data), 'report.xlsx');
    }
}