<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;

class ReportController extends Controller
{
    public function report()
    {
        try {
            $currentDate = Carbon::now();
            $data = DB::table('upload_data')
                ->join('agent_cti', 'upload_data.id', '=', 'agent_cti.upload_data_id')
                ->select("*")
                ->whereDate('agent_cti.created_at', $currentDate)
                ->get();
            return view('reportwork.report', compact('data'));
        } catch (Exception $e) {
            return back()->with("error","Something Went Wrong");
        }
    }
    
    public function daterange(Request $request)
    {
        try {
            $array = explode("@", $request->dateRangehid);
            // print_r($array);
            $startDate = $array[0];
            $endDate = $array[1];
            $data = DB::table('upload_data')
                ->join('agent_cti', 'upload_data.id', '=', 'agent_cti.upload_data_id')
                ->select("*")
                ->whereRaw('DATE(agent_cti.created_at) BETWEEN ? AND ?', [date('Y-m-d', strtotime($startDate)), date('Y-m-d', strtotime($endDate))])
                ->get();
            // dd($data);
            return view('reportwork.report', compact('data'));
        } catch (Exception $e) {
            return back()->with("error","Something Went Wrong");
        }
    }
    
}