<?php

namespace App\Services;

use App\Exports\ReportExport;
use App\Services\Interface\ExportServiceInterface;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;

class ExcelService implements ExportServiceInterface {
    private $data;
    private $user;
    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function generate()
    {
        return $this->excel->download(new ReportExport($this->data), 'report.xlsx');

    }
}