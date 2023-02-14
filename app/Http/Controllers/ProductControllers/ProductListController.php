<?php

namespace App\Http\Controllers\ProductControllers;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Product;

class ProductListController extends BaseController
{
    public function __invoke()
    {
        //TODO: Implement pagination
        $products = Product::with([
            'categories' => function ($query) {
                $query->select('id', 'name')->where('enable', 1);
            },
            'images' => function ($query) {
                $query->select('id', 'name', 'file')->where('enable', 1);
            },
        ])->where('enable', true)->get(['id', 'name', 'description']);
        
        return $this->generateResponse(200, 'OK', $products);
    }
}
