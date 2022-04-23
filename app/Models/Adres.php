<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adres extends Model
{
    use HasFactory;
    protected $table="adres";
    protected $fillable = [
        'user_id','adres','title'
    ];

    public function getUser(){
        return $this->belongsTo(User::class,"user_id");
    }

    

}
