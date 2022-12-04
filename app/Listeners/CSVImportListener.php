<?php

namespace App\Listeners;

use App\Events\CSVImportEvent;
use App\Models\Customer;
use App\Services\Users\UserService;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Log\Logger;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Rap2hpoutre\FastExcel\FastExcel;

class CSVImportListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param \App\Events\CSVImportEvent $event
     * @return array
     * @throws \OpenSpout\Common\Exception\IOException
     * @throws \OpenSpout\Common\Exception\UnsupportedTypeException
     * @throws \OpenSpout\Reader\Exception\ReaderNotOpenedException
     */
    public function handle(CSVImportEvent $event): array
    {
        $filePath = Storage::put('/csv', $event->data['csv_file']);
        $dataMessage = [];

        $result = (new FastExcel())->import( Storage::disk('local')->path($filePath), function ($line) {
            $dataImports = [];
            if ($line['First Name'] && $line['Last Name'] && $line['Email'] && $line['Phone']) {
                $dataImports += [
                    'first_name' => $line['First Name'],
                    'last_name' => $line['Last Name'],
                    'email' => $line['Email'],
                    'phone' => $line['Phone'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }

            return $dataImports;
        });

        try {
            DB::beginTransaction();
            collect($result)
                ->chunk(10000)
                ->each(function ($customer) {
                    app(UserService::class)->importCustomer($customer->toArray());
                });

            DB::commit();

            $dataMessage = [
                'status' => true,
                'message' => __('Import successfully'),
            ];
        }catch (\Exception $e) {
            DB::rollBack();

            Log::info($e);
            $dataMessage = [
                'status' => false,
                'message' => __('Import fail'),
            ];
        }

        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }

        return $dataMessage;
    }
}
