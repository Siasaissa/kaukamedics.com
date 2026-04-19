<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    public function model(array $row)
    {
        // Skip header row if necessary
        if ($row[0] === 'name' || $row[0] === null) {
            return null;
        }

        return new Product([
            'name'  => $row[0],
            'unit'  => $row[1],
            'price' => $row[2],
        ]);
    }
}
