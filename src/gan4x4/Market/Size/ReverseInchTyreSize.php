<?php

namespace gan4x4\Market\Size;
use gan4x4\Market\Tyre;

class ReverseInchTyreSize extends TyreSize {
    static protected $pattern = "/^[\D]*?([12]?\d(\.\d)?)[\/]+(\d{2}([\.,]\d)?)\s?[-]+(\d{2}([\.,]\d)?)/";
    function __construct($size) {
        parent::__construct($size);
        $this->checkSize($this->getOriginal(), $this->matches);
        //var_dump($this->matches);
        $this->width = self::getFloat($this->matches[1]);
        $this->heigth = self::getFloat($this->matches[3]);
        $this->cord= self::CORD_DIAGONAL;
        $this->disk = self::getFloat($this->matches[5]);
        $this->Validate();
    }
    
    public function getClearOriginal(){
        $h =  self::round5Float($this->getHeigth());
        $w =  self::round5Float($this->getWidth());
        $cordSym =  self::getCordSymbol($this->getCord());
        $d = $this->getDisk();
        return $w.'x'.$h.$cordSym.$d;
    }
}
