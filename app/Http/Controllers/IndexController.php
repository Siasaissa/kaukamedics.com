<?php

namespace App\Http\Controllers;

use App\Concerns\ResolvesProductImages;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    use ResolvesProductImages;

    public function index(){

$products = $this->withImageUrls(
    Product::orderByDesc('id')
        ->take(4)
        ->get()
);

$products1 = $this->withImageUrls(
    Product::orderByDesc('id')
        ->skip(4)
        ->take(4)
        ->get()
);

$products2 = $this->withImageUrls(
    Product::orderByDesc('id')
        ->skip(8)
        ->take(4)
        ->get()
);
$produc = $this->withImageUrls(Product::all());

        return view('index', compact('products','products1','products2','produc'));
    }
    private function withImageUrls($products)
    {
        return $this->appendImageUrls($products);
    }
}
