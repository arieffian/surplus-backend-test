<?php

namespace App\Http\Controllers\CategoryControllers;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateCategoryController extends BaseController
{
    public function __invoke(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string',
            'enable' => 'required|boolean'
        ];
        $data = [
            'name' => $request->name,
            'enable' => $request->enable
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return $this->generateResponse(400, 'Validation Error', $validator->errors());
        }

        $category = Category::find($id);
        if ($category === null) {
            return $this->generateResponse(404, 'Error: ID not found', []);
        }

        $category->name = $data['name'];
        $category->enable = $data['enable'];
        $category->save();

        return $this->generateResponse(202, 'OK', $category);
    }
}
