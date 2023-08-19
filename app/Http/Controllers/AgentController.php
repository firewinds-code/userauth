<?php

namespace App\Http\Controllers;
use App\Models\UploadData;
use App\Models\AgentData;
use Illuminate\Http\Request;
use Exception;

class AgentController extends Controller
{
    public function agent()
    {
        try {
            return view('agentfile.agent');
        } catch (Exception $e) {
            return back()->with("error","Something Went Wrong");
        }
    }
    
    public function search(Request $request)
    {
        try {
            $phone = $request->input('search');
            $results = UploadData::where('phone', $phone)->get();
            // dd($results[0]->name);
            if ($results->isEmpty()) {
                return back()->with('error', 'No results found');
            }
            return view('agentfile.agent', ['results' => $results]);
        } catch (Exception $e) {
            return back()->with("error","Something Went Wrong");
        }
    }
    
    public function cti(Request $request)
    {
        try {
            // dd($request->all());
            $user = new AgentData;
            $user->call_disposition = $request->call_disposition;
            $user->call_back = $request->callback;
            $user->remarks = $request->remarks;
            $user->upload_data_id = $request->id1;
            $user->save();
            return redirect('agentfile/agent')->with('success', 'Details Added Successfully');
        } catch (Exception $e) {
            return back()->with("error","Something Went Wrong");
        }
    }
}