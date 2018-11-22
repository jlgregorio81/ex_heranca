<?php 
namespace core\util;

class File{

    public static function saveUploadedFile($fileName, $destination){
        if(is_uploaded_file($fileName)){
            move_uploaded_file($fileName,$destination);
            return $destination;            
        }
    }

   

}