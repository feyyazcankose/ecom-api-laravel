<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table="categories";
    protected $fillable = [
        'title',
        'slug',
        'banner',
    ];

    public function getFields(){
        return $this->hasMany(CategoryField::class,"category_id");
    }
}
