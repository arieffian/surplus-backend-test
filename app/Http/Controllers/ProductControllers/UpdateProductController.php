<?php

namespace App\Http\Controllers\ProductControllers;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateProductController extends BaseController
{
    public function __invoke(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string',
            'enable' => 'required|boolean',
            'description' => 'required|string',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'images' => 'required|array',
            'images.*' => 'exists:images,id',
        ];
        $data = [
            'name' => $request->input('name'),
            'enable' => $request->input('enable'),
            'description' => $request->input('description'),
            'categories' => $request->input('categories'),
            'images' => $request->input('images')
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return $this->generateResponse(400, 'Validation Error', $validator->errors());
        }

        $product = Product::find($id);
        if ($product === null) {
            return $this->generateResponse(404, 'Error: ID not found', []);
        }


        $product->name = $data['name'];
        $product->enable = $data['enable'];
        $product->description = $data['description'];
        $product->save();

        $product->categories()->sync($data['categories']);
        $product->images()->sync($data['images']);

        $product = Product::with([
            'categories' => function ($query) {
                $query->select('id', 'name')->where('enable', 1);
            },
            'images' => function ($query) {
                $query->select('id', 'name', 'file')->where('enable', 1);
            },
        ])->where('enable', true)->where('id', $product->id)->first(['id', 'name', 'description']);

        return $this->generateResponse(202, 'OK', $product);
    }
}
