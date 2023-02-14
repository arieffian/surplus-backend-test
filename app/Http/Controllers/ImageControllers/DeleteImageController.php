<?php

namespace App\Http\Controllers\ImageControllers;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Image;
use Illuminate\Http\Request;

class DeleteImageController extends BaseController
{
    public function __invoke(Request $request, $id)
    {
        $image = Image::find($id);
        if ($image === null) {
            return $this->generateResponse(404, 'Error: ID not found', []);
        }

        $image->delete();
        //TODO: delete image file
        //TODO: detach from product

        return $this->generateResponse(202, 'OK', []);
    }
}
