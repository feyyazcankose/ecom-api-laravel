<?php 

namespace App\Customs;

class Table{

    public function __construct(array $columns,array $rows,array $items){
        $this->table = [   
            "columns"=>$columns,
            "rows"=>$rows,
            "items"=>$items,
        ];
    }

    public function get(){
        return $this->table;
    }
    
}