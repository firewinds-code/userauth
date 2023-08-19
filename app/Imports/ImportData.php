<?php

namespace App\Imports;

use App\Models\UploadData;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;


class ImportData implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $firstRowSkipped = false;
        foreach ($rows as $row) {
            if (!$firstRowSkipped) {
                $firstRowSkipped = true;
                continue; // Skip the first row (heading row)
            }
            
            
            $existingEmails = [];
            $records = [];

            foreach ($rows as $row) {
                $email = $row[1];

                $existingRecord = UploadData::where('email', $email)->first();

                if ($existingRecord) {
                    // Email already exists, handle the validation error
                    return back()->with('error', 'Duplicate entry found');
                }

                $existingEmails[] = $email;

                $records[] = [
                    'name'     => $row[0],
                    'email'    => $email, 
                    'phone'    => $row[2],
                    'cusid'    => $row[3],
                ];
            }

            UploadData::insert($records);

            return back()->with('success', 'Data Uploaded successfully');

        }
    }
}