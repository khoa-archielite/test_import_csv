<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Csv\CsvRequest;
use App\Services\Csv\CsvService;
use Illuminate\Http\Request;
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
        //
    }

    /**
     * @param \App\Http\Requests\Csv\CsvRequest $request
     */
    public function importCSV(CsvRequest $request)
    {

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('csv.import');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->file('csv_file');

        $data->move(public_path('upload/imgdogs/'), $data->getClientOriginalName());

        $excel = (new FastExcel())->import(public_path('upload/imgdogs/') . $data->getClientOriginalName() ?: '', function ($line) {
            return User::create([
                'first_name' => !empty($line['First Name']) ? $line['First Name'] : 'No name',
                'last_name' => !empty($line['Last Name']) ? $line['Last Name'] : 'No name',
                'email' => !empty($line['Email']) ? $line['Email'] : 'example@gmail.com',
                'phone' => !empty($line['Phone']) ? $line['Phone']: '0389643555',
            ]);
        });

        return redirect()->back();
    }

    /**
     * @return \Generator
     */
    function usersGenerator() {
        foreach (User::cursor() as $user) {
            yield $user;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
