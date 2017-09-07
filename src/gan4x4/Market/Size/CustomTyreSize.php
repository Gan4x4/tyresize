<?php

namespace gan4x4\Market\Size;

class CustomTyreSize extends TyreSize {
    //static protected $pattern = "/^[\D]*?Q(78)-(1[56])/";
    
    function __construct($size) {
        parent::__construct($size);
        $size = trim($this->getOriginal());
        switch ($size) {
            case '160':
            case '160м':
                // Ф-Бел 160
                    $this->heigth = 36.6;
                    $this->width = 12.4;
                    $this->cord= TyreSize::CORD_DIAGONAL;
                    $this->disk = 16;

                break;

            default:
                
                
                break;
        }
        
        $this->Validate();
    }
    
    public static function checkSize($size,&$matches = null){
        switch ($size) {
            case '160':
            case '160м':
                // Ф-Бел 160
                    return true;

            default:
                return false;

        }
    }
    
    public function getClearOriginal(){
        return trim($this->getOriginal());
    }
}
