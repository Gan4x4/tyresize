<?php

namespace gan4x4\Market\Size;

class FullProfileTyreSize extends TyreSize{
    static protected $pattern = "/^[\D]*?(\d{3})([R-])([12]\d{1}(\.\d)?)/";
    function __construct($size) {
        parent::__construct($size);
        
        $this->checkSize($this->getOriginal(), $this->matches);
        $this->width = self::getFloat($this->matches[1])/self::INCH;
        $this->cord = self::getCordFromDelim($this->matches[2]);
        $this->disk = self::getFloat($this->matches[3]);
        $profile = 0.8; //82?
        $this->heigth = $this->width*2*$profile+$this->disk;
        $this->Validate();
    }
    
    public function getClearOriginal(){
        $w =  $this->getCm_W();
        $cordSym =  self::getCordSymbol($this->getCord());
        $d = $this->getDisk();
        return $w.$cordSym.$d;
    }
}