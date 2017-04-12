<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace gan4x4\Tests\Market\Size;

use gan4x4\Market\Size\TyreSize;
use gan4x4\Market\Size\ReverseInchTyreSize;

  
class ReverseInchTyreSizeTest extends TyreSizeTest {

    public function testIsReverseInchSizePositive() {
        $this->assertTrue(ReverseInchTyreSize::checkSize("	18/39.5-15"));
        $this->assertTrue(ReverseInchTyreSize::checkSize("19.5/44 -16.5LT"));
        $this->assertTrue(ReverseInchTyreSize::checkSize("15/38.5-16.5LT"));
     
    }
    
    public function testIsReverseInchSizeLowWidthPositive() {
        $this->assertTrue(ReverseInchTyreSize::checkSize("	9/34-16LT")); // Narrow ss
    }
    
    public function testIsReverseInchSizeNegative(){
        $this->assertFalse(ReverseInchTyreSize::checkSize("185/65-15"));
        $this->assertFalse(ReverseInchTyreSize::checkSize("35/12.5R16"));
        
    }
    
    public function testReverseInchSizeConstructor() {
        $this->checkSizesList($this->reverse, 'ReverseInchTyreSize');
    }
    
     public function testReverseInchSizeGetDiagonalCord(){
        $size = new ReverseInchTyreSize("19.5/44 -16.5LT");
        $this->assertEquals(TyreSize::CORD_DIAGONAL,$size->getCord());
    }
}