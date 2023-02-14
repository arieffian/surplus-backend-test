<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Image extends Model
{
    protected $table = 'images';
    protected $fillable = ['name', 'file', 'enable'];
    public $timestamps = false;
    protected $hidden = ['pivot'];
 
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_image', 'image_id', 'product_id');
    }
}