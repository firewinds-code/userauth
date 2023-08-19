<?php
  
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Exports\ExportData;
use App\Imports\ImportData;
use Maatwebsite\Excel\Facades\Excel;
use Exception;
use App\Models\UploadData;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
  
class DataController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function index()
    {
        try {
            $users = UploadData::get();
            return view('uploaddata.excel', compact('users'));
        } catch (Exception $e) {
            return back()->with("error","Something Went Wrong");
        }
    }
        
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        try {
            return Excel::download(new ExportData(), 'format.csv');
        } catch (Exception $e) {
            return back()->with("error","Something Went Wrong");
        }
    }
       
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function import(Request $request) 
    {
        try {
            $validator = Validator::make($request->all(), [
                'file' => 'required|mimes:xls,xlsx',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            else
            {
                Excel::import(new ImportData(), $request->file('file'));
                return redirect()->back()->with('success', 'Data imported successfully.');
            }
        }catch (Exception $e) {
            return back()->with("error","Something Went Wrong");
        }   
    }
}