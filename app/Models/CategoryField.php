<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryField extends Model
{
    use HasFactory;
    protected $table="category_fields";
    protected $fillable = [
        'category_id',
        'type',
        'name'
    ];

    public function getValues(){
        return $this->hasMany(CategoryFieldValue::class,"category_field_id");
    }
}
