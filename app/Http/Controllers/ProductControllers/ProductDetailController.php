<?php

namespace App\Http\Controllers\ProductControllers;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductDetailController extends BaseController
{
    public function __invoke(Request $request, $id)
    {
        $rules = [
            'id' => 'required|integer'
        ];
        $data = [
            'id' => $id
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return $this->generateResponse(400, 'Validation Error', $validator->errors());
        }

        $product = Product::with([
            'categories' => function ($query) {
                $query->select('id', 'name')->where('enable', 1);
            },
            'images' => function ($query) {
                $query->select('id', 'name', 'file')->where('enable', 1);
            },
        ])->where('enable', true)->where('id', $id)->first(['id', 'name', 'description']);
        
        if ($product === null) {
            return $this->generateResponse(404, 'Error: ID not found', []);
        }
        return $this->generateResponse(200, 'OK', $product);
    }
}
