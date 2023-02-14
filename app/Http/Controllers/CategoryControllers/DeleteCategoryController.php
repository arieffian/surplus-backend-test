<?php

namespace App\Http\Controllers\CategoryControllers;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeleteCategoryController extends BaseController
{
    public function __invoke(Request $request, $id)
    {
        $category = Category::find($id);
        if ($category === null) {
            return $this->generateResponse(404, 'Error: ID not found', []);
        }

        $category->delete();

        return $this->generateResponse(202, 'OK', []);
    }
}
