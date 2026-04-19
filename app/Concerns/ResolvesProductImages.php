<?php

namespace App\Concerns;

use Illuminate\Support\Str;

trait ResolvesProductImages
{
    protected function appendImageUrls($products)
    {
        return $products->map(function ($product) {
            return $this->appendImageUrl($product);
        });
    }

    protected function appendImageUrl($product)
    {
        $imagePath = trim((string) ($product->image ?? ''));
        $normalized = str_replace('\\', '/', $imagePath);
        $normalized = ltrim(str_replace(['storage/app/public/', 'storage/'], '', $normalized), '/');
        $imageUrl = asset('img/defaultmedical.jpg');

        if ($imagePath !== '') {
            if (Str::startsWith($imagePath, ['http://', 'https://'])) {
                $imageUrl = $imagePath;
            } elseif (file_exists(storage_path('app/public/' . $normalized))) {
                $imageUrl = asset('storage/app/public/' . $normalized);
            } elseif (file_exists(public_path('storage/' . $normalized))) {
                $imageUrl = asset('storage/' . $normalized);
            } elseif (file_exists(public_path($imagePath))) {
                $imageUrl = asset($imagePath);
            }
        }

        $product->image_url = $imageUrl;

        return $product;
    }
}
