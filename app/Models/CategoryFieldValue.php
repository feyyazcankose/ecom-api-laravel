<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryFieldValue extends Model
{
    use HasFactory;
    protected $table="category_field_values";
    protected $fillable = [
        'category_field_id','product_id','value'
    ];
}
