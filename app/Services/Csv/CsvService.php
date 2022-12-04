<?php

namespace App\Services\Csv;

use App\Events\CSVImportEvent;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Rap2hpoutre\FastExcel\FastExcel;

class CsvService
{
    public function importCsv($data)
    {
        $response = CSVImportEvent::dispatch($data);

        if (is_array($response) && isset($response[0]['status'])) {
            return $response[0];
        }

        return false;
    }
}
