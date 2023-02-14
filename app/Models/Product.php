<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'description', 'enable'];
    public $timestamps = false;
    protected $hidden = ['pivot'];
 
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'product_image', 'product_id', 'image_id');
    }
}