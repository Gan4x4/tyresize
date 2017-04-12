<?php

namespace gan4x4\Market;

abstract class Size {
    const INCH = 25.4;
    private $original;
    //put your code here
    
    protected function __construct($param) {
        $this->original = $param;
    }
    
    public function getOriginal(){
        return $this->original;
    }
    
    abstract function Validate();
}
