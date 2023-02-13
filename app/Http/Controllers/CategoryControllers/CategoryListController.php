<?php

namespace App\Http\Controllers\CategoryControllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
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
