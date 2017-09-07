<?php

namespace gan4x4\Tests\Market\Size;
use gan4x4\Market\Size\CustomTyreSize;


class CustomTyreSizeTest extends TyreSizeTest {

public function testIsCustomSizePositive() {
        $this->assertTrue(CustomTyreSize::checkSize("160"));
    }
    
    
    public function testFullAmericanSizeConstructor() {
        $this->checkSizesList($this->custom, 'CustomTyreSize');
    }
    
    public function testCustomSizeNegative(){
        //$size = new AmericanTyreSize("150");
        $this->assertFalse(CustomTyreSize::checkSize("150"));
    }
    
}