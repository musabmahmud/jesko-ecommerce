<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use HasFactory,SoftDeletes;
    function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    function brand(){
        return $this->belongsTo(Brand::class,'category_id');
    }
}
