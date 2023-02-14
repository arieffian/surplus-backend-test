<?php

namespace App\Http\Controllers\ImageControllers;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Image;

class ImageListController extends BaseController
{
    public function __invoke()
    {
        //TODO: Implement pagination
        $images = Image::where('enable', true)->get(['id', 'name', 'file']);
        return $this->generateResponse(200, 'OK', $images);
    }
}
