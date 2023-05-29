<?php

namespace App\Imports;

// use App\Models\Manufacturerauthority;
// use App\Models\Country;
use App\Models\Size;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;

class CategoryImport implements ToModel
{
    public function model(array $row)
    {
        $name = $row[0];

       
       
        // $country = Country::where('name', $row[1])->first();
        // $registration = Manufacturerauthority::where('name', $row[3])->first();
        

        // Validate the name value
        if (empty($name)) {
            // Log an error or skip creating the model for this row
            Log::error('Empty name value for row: ' . implode(', ', $row));
            return null;
        }
        return new Size([
            'name'=>$row[0],
            // 'registration_number'=>$row[2],
            // 'registration_validity'=>$row[4],
            // 'registration_authority'=>$registration ? $registration->id : null,
            // 'country_id' => $country ? $country->id : null,
            'author_id' => 1,
        ]);
    }
}
