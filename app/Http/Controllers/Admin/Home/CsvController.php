<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Csv\CsvRequest;
use App\Models\Customer;
use App\Services\Csv\CsvService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Collection;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\User;

class CsvController extends Controller
{

    protected $CsvService;

    public function __construct(CsvService $CsvService)
    {
        $this->CsvService = $CsvService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('csv.import');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('frontend.csv.import');
    }

    /**
     * @param \App\Http\Requests\Csv\CsvRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CsvRequest $request): RedirectResponse
    {

        $data = $request->validated();

        if ($result = $this->CsvService->importCsv($data)) {
            session()->flash($result['status'] ? 'success' : 'fail', __($result['message']));

            return redirect()->route('index');
        }

        session()->flash('fail', __('Import fail'));

        return redirect()->route('csv.create');
    }
}
