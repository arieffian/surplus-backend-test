<?php

namespace App\Http\Controllers\ImageControllers;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateImageController extends BaseController
{
    public function __invoke(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string',
            'enable' => 'required|boolean',
            'file' => 'required|file'
        ];
        $data = [
            'name' => $request->name,
            'enable' => $request->enable,
            'file' => $request->file('file')
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return $this->generateResponse(400, 'Validation Error', $validator->errors());
        }

        $image = Image::find($id);
        if ($image === null) {
            return $this->generateResponse(404, 'Error: ID not found', []);
        }

        $filename = md5(time()).'.'.$request->file('file')->extension();

        $file = $request->file('file');
        $file->move(storage_path('app/public/images'), $filename);

        $data['file'] = '/storage/images/' . $filename;

        $image->name = $data['name'];
        $image->enable = $data['enable'];
        $image->file = $data['file'];
        $image->save();
        //TODO: Delete old file

        return $this->generateResponse(202, 'OK', $image);
    }
}
