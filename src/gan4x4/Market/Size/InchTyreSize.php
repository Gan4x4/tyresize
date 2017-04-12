<?php

namespace gan4x4\Market\Size;

class InchTyreSize extends TyreSize{

    static protected $pattern = "/^[\D]*?([23456]\d([\.,]\d0?)?)[*ХхxX\/]+([12]?\d([\.,]\d{1,2})?)\s?([-RD])+(\d{2}([\.,]\d)?)/";
    
    
    
    function __construct($size) {
        // remove whitespace
        $clear = preg_replace('/\s+/S', "", $size);
        parent::__construct($clear);
        
        
        $this->checkSize($this->getOriginal(), $this->matches);
        $this->heigth = self::getFloat($this->matches[1]);
        $this->width = self::getFloat($this->matches[3]);
        $this->cord = self::getCordFromDelim($this->matches[5]);
        $this->disk = self::getFloat($this->matches[6]);
        $this->Validate();
    }
    
    public function getClearOriginal(){
        return $this->getInchName();
    }
}
