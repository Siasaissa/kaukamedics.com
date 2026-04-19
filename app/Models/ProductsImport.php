<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
     * Map each row in the Excel sheet to a Product model.
     */
    public function model(array $row)
    {
        return new Product([
            'name'  => $row[0],
            'items' => $row[1],
            'price' => $row[2],
        ]);
    }
}
