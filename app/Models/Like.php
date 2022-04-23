<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table="likes";
    protected $fillable = [
        'product_id','user_id'
    ];

    public function getProduct(){
        return $this->belongsTo(Product::class,"product_id");
    }

    public function getUser(){
        return $this->belongsTo(User::class,"user_id");
    }
}
