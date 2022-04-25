<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketProduct extends Model
{
    use HasFactory;
    protected $table="basket_products";
    protected $fillable=[
        'basket_id',
        'product_id',
        'price'
    ];
}
