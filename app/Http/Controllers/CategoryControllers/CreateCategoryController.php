<?php

namespace App\Http\Controllers\CategoryControllers;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreateCategoryController extends BaseController
{
    public function __invoke(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'enable' => 'required|boolean'
        ];
        $data = [
            'name' => $request->input('name'),
            'enable' => $request->input('enable')
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return $this->generateResponse(400, 'Validation Error', $validator->errors());
        }

        $category = Category::create($data);
        return $this->generateResponse(201, 'OK', $category);
    }
}
