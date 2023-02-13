<?php

namespace App\Http\Controllers\CategoryControllers;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Category;

class CategoryListController extends BaseController
{
    public function __invoke()
    {
        //TODO: Implement pagination
        $categories = Category::where('enable', true)->get(['id', 'name']);
        return $this->generateResponse(200, 'OK', $categories);
    }
}
