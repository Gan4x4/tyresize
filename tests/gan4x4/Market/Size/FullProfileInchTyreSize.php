<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace gan4x4\Tests\Market\Size;
use gan4x4\Market\Size\FullProfileInchTyreSize;

class FullProfileInchTyreSizeTest extends TyreSizeTest {
    
    public function testIsFullProfileInchSizePositive() {
        $this->assertTrue(FullProfileInchTyreSize::checkSize("7.50-16LT"));
    }
    
    
    public function testIsFullProfileInchSizeNegative() {
        $this->assertFalse(FullProfileInchTyreSize::checkSize("195R16"));
    }
    
    public function testFullProfileInchSizeConstructor() {
        $this->checkSizesList($this->inchfullsize, 'FullProfileInchTyreSize');
    }

    
}