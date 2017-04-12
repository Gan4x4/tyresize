<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace gan4x4\Tests\Market\Size;

use gan4x4\Market\Size\TyreSize;
use gan4x4\Market\Size\FullProfileTyreSize;

class FullProfileTyreSizeTest extends TyreSizeTest {
    

    public function testIsFullProfileSizePodsitive() {
        $this->assertTrue(FullProfileTyreSize::checkSize("195R16"));
    }
    
    public function testFullProfileSizeConstructor() {
        $this->checkSizesList($this->fullsize, 'FullProfileTyreSize');
    }
    
    public function testFullProfileGetRadialCord(){
        $size = new FullProfileTyreSize("205R16");
        $this->assertEquals(TyreSize::CORD_RADIAL,$size->getCord());
    }
   
}