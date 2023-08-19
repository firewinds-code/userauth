<?php

namespace App\Exports;
use App\Models\UploadData;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportData implements WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     $users = array('name', 'email','phone','cusid');
        
    //         return DB::table('upload_data')
    //         ->select($users)
    //         ->get();
          
    // }
    
    public function headings(): array
    {
        return [ 'name', 'email','phone','cusid'];
    }
}