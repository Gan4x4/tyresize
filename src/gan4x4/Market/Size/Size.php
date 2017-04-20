<?php
/*
 * Abstract class for all sizible objects
 * in future can be uset to create wheel size if need
 * 
 */
namespace gan4x4\Market\Size;

abstract class Size {
    const INCH = 25.4;
    private $original;
        
    protected function __construct($param) {
        $this->original = $param;
    }
    
    public function getOriginal(){
        return $this->original;
    }
    
    abstract function Validate();
}
