<?php

namespace App\Http\Controllers;

use App\Customs\Table;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class TableController extends Controller
{   
        public function categories(){
            $colums=["Kategori Başlığı","Kategori Yolu","Kategori Resmi"];
            $rows=["title","slug","banner"];
            
            $category= Category::get(["title","slug","banner","id"])->toArray();
            
            $table =new Table($colums,$rows,$category);
            return response()->json([
                "status"=>200,
                "table"=>$table->get()
            ]);
        }






        public function products(){
            $colums=["Ürün Adı","Ürün Açıklaması","Fiyatı","Stok Adet","Ürün Kategori","Ürün Resmi"];
            $rows=["title","descirptions","price","quantity","product_category","path"];
            
            
            $product= Product::get(["title","descirptions","price","quantity","category_id","id","path"])->each(function($product){
                $product->product_category=$product->getCategory->title;
            })->toArray();
            
    
            
            $table =new Table($colums,$rows,$product);
            return response()->json([
                "status"=>200,
                "table"=>$table->get()
            ]);
        }



        public function users(){
            $colums=["Ad Soyad","E Posta Adresi","Rolü"];
            $rows=["full_name","email","role"];
            
            
            $category= User::get(["email","name","surname","role_id","id"])->each(function($user){
                $user->full_name=$user->full_name;
                $user->role=$user->role_id->title();
            })->toArray();
            
    
            
            $table =new Table($colums,$rows,$category);
            return response()->json([
                "status"=>200,
                "table"=>$table->get()
            ]);
        }
}
