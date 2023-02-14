<?php

namespace App\Http\Controllers\ProductControllers;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Product;
use Illuminate\Http\Request;

class DeleteProductController extends BaseController
{
    public function __invoke(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product === null) {
            return $this->generateResponse(404, 'Error: ID not found', []);
        }

        $product->categories()->detach();
        $product->images()->detach();

        $product->delete();

        return $this->generateResponse(202, 'OK', []);
    }
}
