<?php

namespace gan4x4\Tests\Market\Size;
use gan4x4\Market\Size\AmericanTyreSize;
use gan4x4\Market\Size\TyreSize;

class AmericanTyreSizeTest extends TyreSizeTest {

public function testIsAmericanSizePositive() {
        $this->assertTrue(AmericanTyreSize::checkSize("Q78-15"));
    }
    
    public function testFullAmericanSizeConstructor() {
        $this->checkSizesList($this->fullsize, 'FullProfileTyreSize');
    }
    
    public function testFullProfileGetDiagonalCord(){
        $size = new AmericanTyreSize("Q78-15");
        $this->assertEquals(TyreSize::CORD_DIAGONAL,$size->getCord());
    }
    
    
}