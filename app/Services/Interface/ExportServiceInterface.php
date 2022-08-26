<?php

namespace App\Services\Interface;

interface ExportServiceInterface {
    public function generate();
    public function setData($data);
}