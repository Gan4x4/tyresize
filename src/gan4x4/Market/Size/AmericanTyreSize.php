<?php

namespace gan4x4\Market\Size;

class AmericanTyreSize extends TyreSize {
    static protected $pattern = "/^[\D]*?Q(78)-(1[56])/";
    function __construct($size) {
        parent::__construct($size);
        
        $this->checkSize($this->getOriginal(), $this->matches);
        $this->heigth = 35.5;
        $this->disk = self::getFloat($this->matches[2]);
        $this->cord= TyreSize::CORD_DIAGONAL;
        $this->width = 11;
        $this->Validate();
    }
    
    public function getClearOriginal(){
        return 'Q78'.self::getCordSymbol($this->getCord()).$this->getDisk();
    }
}
