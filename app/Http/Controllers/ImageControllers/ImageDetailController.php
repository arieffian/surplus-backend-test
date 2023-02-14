<?php

namespace App\Http\Controllers\ImageControllers;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageDetailController extends BaseController
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

        $image = Image::where('enable', true)->where('id', $id)->first(['id', 'name', 'file']);
        if ($image === null) {
            return $this->generateResponse(404, 'Error: ID not found', []);
        }
        return $this->generateResponse(200, 'OK', $image);
    }
}
