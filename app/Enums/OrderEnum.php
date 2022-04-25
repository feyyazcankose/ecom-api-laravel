<?php 


namespace App\Enums;


enum OrderEnum:int{

    case CHECKED = 1;
    case WAIT = 2;
    case REPEAL = 3;

    public function title():string
    {
        return match($this){
            self::CHECKED=>"Tamamlandı",
            self::WAIT=>"Beklemede",
            self::REPEAL=>"İptal Edildi"
        };
    }


}
