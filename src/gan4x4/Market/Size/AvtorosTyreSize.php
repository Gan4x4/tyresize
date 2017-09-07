<?php

namespace gan4x4\Market\Size;
use gan4x4\Market\Tyre;

class AvtorosTyreSize extends TyreSize{
    static protected $pattern = "/^[\D]*?([34567]\d{2})[-]+(\d{2})\s?([х])+(\d{2}(\.\d)?)/";
    function __construct($size) {
        parent::__construct($size);
        $this->checkSize($this->getOriginal(), $this->matches);
        $this->width = self::getFloat($this->matches[1])/self::INCH;
        $this->disk = self::getFloat($this->matches[4]);
        $this->cord = TyreSize::CORD_DIAGONAL;
        $percent = self::getFloat($this->matches[2]) / 100;
        $this->heigth = $this->width*$percent*2+$this->disk;
        $this->Validate();
    }
    
    public function getClearOriginal(){
        return $this->getMetricName();
    }
}
