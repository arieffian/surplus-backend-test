<?php

namespace App\Http\Controllers\CategoryControllers;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryDetailController extends BaseController
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

        $category = Category::where('enable', true)->where('id', $id)->first(['id', 'name']);
        if (count($category) === 0) {
            return $this->generateResponse(404, 'Error: ID not found', []);
        }
        return $this->generateResponse(200, 'OK', $category);
    }
}
