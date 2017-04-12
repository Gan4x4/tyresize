<?php

namespace gan4x4\Market\Size;
/*
 * 1150/400R457 Киров-шина КИ 126
 * and other Russian tyres when all dimension include disk im millimeters
 */

class PneumoTyreSize extends TyreSize{
    static protected $pattern = "/^[\D]*?(\d{3,4})[хX]+(\d{3})\s?([R-])(\d{2}(\.\d)?)/";
    function __construct($size) {
        parent::__construct($size);
        
        $this->checkSize($this->getOriginal(), $this->matches);
        //var_dump($this->matches);
        $this->heigth = self::getFloat($this->matches[1])/self::INCH;
        $this->disk = self::getFloat($this->matches[4]);
        $this->width = self::getFloat($this->matches[2])/self::INCH;
        $this->cord = null;
        $this->Validate();
        
    }
    
    public function getClearOriginal(){
        $h =  self::round5Float($this->getHeigth()*self::INCH);
        $w =  self::round5Float($this->getWidth()*self::INCH);
        //This tyres can has radial cord with this symbol
        $cordSym = '-';
        $d = $this->getDisk();
        return $h.'x'.$w.$cordSym.$d;
    }
    
}
