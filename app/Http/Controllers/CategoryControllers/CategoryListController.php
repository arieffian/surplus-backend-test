<?php

namespace App\Http\Controllers\CategoryControllers;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Category;

class CategoryListController extends BaseController
{
    public function __invoke()
    {
        $categories = Category::where('enable', true)->get(['id', 'name']);
        return response()->json($categories);
    }
}
