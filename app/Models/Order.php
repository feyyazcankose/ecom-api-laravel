<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use App\Enums\OrderEnum;
use App\Enums\OrderEnum;
class Order extends Model
{
    use HasFactory;

    protected $table="orders";
    protected $fillable = [
        'basket_id','status','adres_id'
    ];
    
    protected $casts = [
        'status'=> OrderEnum::class,
    ];

    

    public function getBasket(){
        return $this->belongsTo(Basket::class,'basket_id')->where('user_id',auth()->user()->id);
    }

    public function getAdres(){
        return $this->belongsTo(Adres::class,"adres_id")->where('user_id',auth()->user()->id);
    }
}
