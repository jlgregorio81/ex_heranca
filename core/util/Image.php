<?php
namespace core\util;

class Image
{
    private $filePath;
    private $source;
    private $types = array('gif', 'jpg', 'jpeg', 'png');
    
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
        $this->load($filePath);        
    }

    public function setSource($source){
        $this->source = $source;
    }
    
    public function getSource(){
        return $this->source;
    }
 
    public function resize($newW, $newH)
    {
        try{            
            $tmpImg = imagecreatetruecolor($newW, $newH);
            list($w, $h) = getimagesize($this->filePath);            
            imagecopyresampled($tmpImg,$this->source,0,0,0,0,$newW,$newH,$w, $h);
            $this->source = $tmpImg;
        } catch (\Exception $ex){
            throw $ex;
        }
    }

    public function load($filePath)
    {
        //..verifica a extensão.
        try {
            $ext = pathinfo($filePath, PATHINFO_EXTENSION);
            if (in_array($ext, $this->types)) {
                if ($ext == 'jpg' || $ext == 'jpg')
                    $this->source = imagecreatefromjpeg($filePath);
                else if ($ext == 'gif')
                    $this->source = imagecreatefromgif($filePath);
                else $this->source = imagecreatefrompng($filePath);
            } else {
                throw new \Exception("Tipo de arquivo inválido.");
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function save($path, $name){
        $ext = pathinfo($this->filePath, PATHINFO_EXTENSION);
        if(in_array($ext, $this->types)){
            if($ext == 'jpg' || $ext == 'jpeg'){
                imagejpeg($this->source,$path . "/{$name}.jpg");
                return "$path/{$name}.jpg";
            }
            else if ($ext == 'png'){
                imagepng($this->source,$path . "/{$name}.png");
                return "$path/{$name}.png";
            }
            else if ($ext == 'gif'){
                imagegif($this->source,$path . "/{$name}.gif");
                return "$path/{$name}.gif";
            }
        }
    }

}