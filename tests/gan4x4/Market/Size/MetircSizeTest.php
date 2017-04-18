<?php

/* 
 * Test for class that parse European (Metric) tyre sizes e.g. 265/75R16
 */

namespace gan4x4\Tests\Market\Size;
use gan4x4\Market\Size\TyreSize;
use gan4x4\Market\Size\MetricTyreSize;

class MetricTyreSizeTest extends  TyreSizeTest {

    public function testIsMetircSizePositive() {
        $this->assertTrue(MetricTyreSize::checkSize("315/70R17"));
    }

    public function testIsMetircSizeNegative() {
        $this->assertFalse(MetricTyreSize::checkSize("35x12.5R15"));
    }

    
    public function testIsMetircSizeEmptyStringNegative() {
        $this->assertFalse(MetricTyreSize::checkSize(""));
    }
    
    public function testMetircSizeConstructor() {
        $this->checkSizesList($this->metric, 'MetricTyreSize');
    }

    public function testMetircSizeGetRadialCord(){
        $size = new MetricTyreSize("215/75R15");
        $this->assertEquals(TyreSize::CORD_RADIAL,$size->getCord());
    }
    
    public function testMetircSizeGetInchName(){
        $size = new MetricTyreSize("305/65R17");
        $this->assertEquals('32.5x12R17',$size->getInchName());
    }

    public function testMetircSizeGetDiagonalCord(){
        $size = new MetricTyreSize("285/75-16");
        $this->assertEquals(TyreSize::CORD_DIAGONAL,$size->getCord());
    }
    
     public function testExtractDiskMetric() {
        $disk = TyreSize::parseSize("255/60R22")->getWheel();
        $this->assertEquals(22,$disk);
    }
}