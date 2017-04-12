<?php

namespace gan4x4\Market\Size;

class MetricDiskTyreSize extends PneumoTyreSize{
    static protected $pattern = "/^[\D]*?(\d{3,4})[хX\/]+(\d{3})\s?([R-])(\d{3}(\.\d)?)/";
    function __construct($size) {
        parent::__construct($size);
        $this->checkSize($this->getOriginal(), $this->matches);
        $this->heigth = self::getFloat($this->matches[1])/self::INCH;
        $this->disk = round(self::getFloat($this->matches[4])/self::INCH); // Main difference
        $this->width = self::getFloat($this->matches[2])/self::INCH;
        $this->cord = null;
        $this->Validate();
    }
    
    public function getClearOriginal(){
        return $this->getMetricName();
    }
}
