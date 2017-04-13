<?php

namespace gan4x4\Tests\Market\Size;
use gan4x4\Market\Size\TyreSize;
use gan4x4\Market\Size\InchTyreSize;

    class InchTyreSizeTest extends  TyreSizeTest {

    public function testIsInchSizeTypicalPositive() {
        $this->assertTrue(InchTyreSize::checkSize("31x10.5R15"));
    }
    
    public function testIsInchSizeWithWhiteSpacePositive() {
        $this->assertTrue(InchTyreSize::checkSize("  35x10.5 R22 "));
    }
    
    public function testIsInchSizeDiagonalPositive() {
        $this->assertTrue(InchTyreSize::checkSize("36x10-16"));
    }
    
    public function testIsInchSizeHummerWheelPositive() {
        $this->assertTrue(InchTyreSize::checkSize("37x12.5-16.5"));
    }
    
    public function testIsInchSizeCommaPositive() {
        $this->assertTrue(InchTyreSize::checkSize("LT31x10,5 R17"));
    }
    
     
    public function testIsInchSizeBigXPositive() {
        $this->assertTrue(InchTyreSize::checkSize("BFG 30X9.50R15"));
    }
    
    public function testIsInchSizeCrazyDelimPositive() {
        $this->assertTrue(InchTyreSize::checkSize(" 30/9.50R15"));
    }
    
    public function testIsInchSizeStarkPositive() {
        // With Russian x
        $this->assertTrue(InchTyreSize::checkSize("39.5х16.5-16"));
    }
 
    public function testIsInchSizeThreeDigitHeigthNegative() {
        $this->assertFalse(InchTyreSize::checkSize("300x9.50R15"));
    }
    
    public function testIsInchWithMetricNegative() {
        $this->assertFalse(InchTyreSize::checkSize("285/75R16"));
    }
    
    public function testIsInchEmptyStringNegative() {
        $this->assertFalse(InchTyreSize::checkSize(""));
    }

    public function testInchSizeConstructor() {
        $this->checkSizesList($this->inch, 'InchTyreSize');
    }

    public function testInchSizeGetRadialCord(){
        $size = new InchTyreSize("31x10.5R15");
        $this->assertEquals(TyreSize::CORD_RADIAL,$size->getCord());
    }
    
    public function testInchSizeGetDiagonalCord(){
        $size = new InchTyreSize("36x12.5-16");
        $this->assertEquals(TyreSize::CORD_DIAGONAL,$size->getCord());
    }
    
    
    public function testInchSizeGetMetricName(){
        $size = new InchTyreSize("36x12.5-15");
        $this->assertEquals('320/85-15',$size->getMetricName());
    }
    
    public function testInchSizeGetInchName(){
        $size = new InchTyreSize("36x12.5-15");
        $this->assertEquals("36x12.5-15",$size->getInchName());
    }
    
    public function testInchSizeGetInchNameComma(){
        $size = new InchTyreSize("32X11,50R15LT");
        $this->assertEquals("32x11.5R15",$size->getInchName());
    }
    
    public function testIsInchSizeProcomp() {
        
        $this->assertTrue(InchTyreSize::checkSize("38.50X14.50R18"));
    }


    public function testExtractDiskInch() {
        $disk = TyreSize::parseSize("36x12.5-16")->getDisk();
        $this->assertEquals(16,$disk);
    }
    
    
    public function testSizeConversion(){
        $size = TyreSize::parseSize("36x12.5-16");
        $this->assertClassesEqual('InchTyreSize',get_class($size));
        
        // Metric eqivalent is 315.5/80-16
        $this->assertEquals(320,$size->getMetricWidth());
        $this->assertEquals(80,$size->getProfile());
        $this->assertEquals("320/80-16",$size->getMetricName());
    }
    
    public function testExtractDiskHummer() {
        $disk = TyreSize::parseSize("35x12,5R16.5")->getDisk();
        $this->assertEquals(16.5,$disk);
    }
    
    
    public function testConstructorNegative() {
        try{
            $size = TyreSize::parseSize('blablabla');
            $this->assertTrue(false);
        } catch (\Exception $ex) {
            $this->assertTrue(true);
        }
    }
    
    
    public function testCreatingInchSize(){
        
    }
    
    
}