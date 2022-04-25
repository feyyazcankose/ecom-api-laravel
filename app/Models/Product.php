<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = [
        "category_id",
        "title",
        "descirptions",
        "price",
        "quantity",
        "details",
        "path"
    ];


    public function getCategory(){
        return $this->belongsTo(Category::class,"category_id");
    }

    public function getLikes(){
        return $this->hasMany(Like::class,"product_id")->where('likes.user_id',auth()->user()->id);
    }



}
