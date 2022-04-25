<?php


namespace App\Customs;

use App\Enums\UploadEnum;
use Illuminate\Support\Facades\File;

class Upload {

    public function __construct( $file,string $fileName,UploadEnum $prefix){
        $this->file = $file;
        $this->fileName = $this->name($fileName);
        $this->prefix = $prefix->value;
    }

  
    public function upload(){

        $this->folderCreate("upload");
        

        $extension = $this->file->getClientOriginalExtension();
        $fileName = $this->fileName.'_'.time() . '.' . $extension;
        
        $this->folderCreate("upload/".$this->prefix);


        $this->file->move("upload/".$this->prefix,$fileName);


        return "upload/".$this->prefix.'/'.$fileName;
    }


    public function name(string $name){
        $search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ');
        $replace = array('c','c','g','g','i','i','o','o','s','s','u','u','-');
        return str_replace($search,$replace,$name);
    }

    public function folderCreate($name){
        $path = public_path($name);
        if(!File::isDirectory($path))
            File::makeDirectory($path, 0777, true, true);
        
    }
}
