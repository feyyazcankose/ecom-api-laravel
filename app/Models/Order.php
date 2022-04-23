<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table="orders";
    protected $fillable = [
        'product_id','user_id','price'
    ];

    public function getUser(){
        return $this->belongsTo(User::class,"user_id");
    }

    public function getProduct(){
        return $this->belongsTo(Product::class,"product_id");
    }
}
