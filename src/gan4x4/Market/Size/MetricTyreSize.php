<?php

namespace gan4x4\Market\Size;

class MetricTyreSize extends TyreSize{
    static protected $pattern = "/^[\D]*?([1234567]\d{2})[\/]+(1?\d{2})\s?([R-])+(\d{2}(\.\d)?)/";
    function __construct($size) {
        parent::__construct($size);
        $this->checkSize($this->getOriginal(), $this->matches);
        $this->width = self::getFloat($this->matches[1])/self::INCH;
        $this->disk = self::getFloat($this->matches[4]);
        $this->cord = self::getCordFromDelim($this->matches[3]);
        $percent = self::getFloat($this->matches[2]) / 100;
        $this->heigth = $this->width*$percent*2+$this->disk;
        $this->Validate();
    }
    
    public function getClearOriginal(){
        return $this->getMetricName();
    }
}
