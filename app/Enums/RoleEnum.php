<?php

namespace App\Enums;

enum RoleEnum:int {

    case ADMIN=1;
    case USER=2;

    public function title():string {
        return match($this){
            self::ADMIN=>"Yönetici",
            self::USER=>"Kullanıcı",
        };
    }

}