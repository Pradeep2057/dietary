<?php

namespace App\Imports;


use App\Models\Product;
use App\Models\Importer;
use App\Models\Productimporter;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;

class CategoryImport implements ToModel
{
    public function model(array $row)
    {
        $name = $row[0];
        
        if (!empty($name)) {
            $product = Product::where('name', $row[0])->first();
            $importer = Importer::where('name', $row[1])->first();
       if($product){
        if($importer){
            return new Productimporter([
                    'product_id'=>$product->id,
                    'importer_id'=>$importer->id,
            ]);
        }
        }
        }

        
    }
}
