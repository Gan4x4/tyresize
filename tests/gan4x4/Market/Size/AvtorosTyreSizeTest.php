<?php

// Instead of other pneumo-tyre manufacturer Avtoros company combine metric heigth with inch width
namespace gan4x4\Tests\Market\Size;
use gan4x4\Market\Size\AvtorosTyreSize;

class AvtorosTyreSizeTest extends TyreSizeTest {
    
   
    
    public function testIsAvtorosSizeTypicalPositive() {
        $this->assertTrue(AvtorosTyreSize::checkSize("450-45х18"));
    }
    
    public function testAvtorosSizeGetMetricName(){
        $size = new AvtorosTyreSize("700-55х21 LT");
        $this->assertEquals('700/55-21',$size->getMetricName());
    }
    
    public function testAvtorosSizeGetInchName(){
        $size = new AvtorosTyreSize("600-55х21 LT");
        $this->assertEquals("46x23.5-21",$size->getInchName());
    }
  
   
    
}