<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reports;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Bus;
use App\Jobs\CreateReport;
use App\Jobs\ReportRegister;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Reports::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        Log::info('request', $req->all());
        $file = "{$req->title}.xlsx";
        $data = User::whereBetween('birth_date',[$req->startDate,$req->endDate])->get();

        Bus::chain([
            new CreateReport($data, $file),
            new ReportRegister($req->title, $file)
        ])->dispatch();

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $report = Reports::findOrFail($id);
        return Storage::download($report->report_link);
        //return $report;
    }
}
