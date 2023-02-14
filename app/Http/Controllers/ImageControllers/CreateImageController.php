<?php

namespace App\Http\Controllers\ImageControllers;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CreateImageController extends BaseController
{
    public function __invoke(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'enable' => 'required|boolean',
            'file' => 'required|file'
        ];
        $data = [
            'name' => $request->input('name'),
            'enable' => $request->input('enable'),
            'file' => $request->file('file')
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return $this->generateResponse(400, 'Validation Error', $validator->errors());
        }

        $filename = md5(time()).'.'.$request->file('file')->extension();

        $file = $request->file('file');
        $file->move(storage_path('app/public/images'), $filename);

        $data['file'] = '/storage/images/' . $filename;

        $image = Image::create($data);
        return $this->generateResponse(201, 'OK', $image);
    }
}
