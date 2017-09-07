<?php

namespace gan4x4\Market\Size;

class FullProfileInchTyreSize extends TyreSize{
    static protected $pattern = "/^[^Q|\D]*?(\d{1,2}[\.,]\d0?)([R-])(\d{2}(\.\d)?)/";
    function __construct($size) {
        parent::__construct($size);
        
        $this->checkSize($this->getOriginal(), $this->matches);
        $this->width = self::getFloat($this->matches[1]);
        $this->cord = self::getCordFromDelim($this->matches[2]);
        $this->disk = self::getFloat($this->matches[3]);
        $profile = 0.8; //82?
        $this->heigth = $this->width*2*$profile+$this->disk;
        $this->Validate();
    }
    public function getClearOriginal(){
        $w =  $this->getInch_W();
        $cordSym =  self::getCordSymbol($this->getCord());
        $d = $this->getDisk();
        return $w.$cordSym.$d;
    }
    
}