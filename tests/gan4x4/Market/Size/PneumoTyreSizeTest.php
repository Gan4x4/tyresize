<?php

namespace gan4x4\Tests\Market\Size;

use gan4x4\Market\Size\TyreSize;
use gan4x4\Market\Size\PneumoTyreSize;


  
class PneumoTyreSizeTest extends TyreSizeTest {
        
        
        
    public function testClearOriginal() {
        $size = TyreSize::parseSize('	1700х750-26');
        $this->assertEquals($size->getClearOriginal(),"1700x750-26");
    }
   /*
    public function testAvtorosSizeGetMetricName(){
        $size = new AvtorosTyreSize("700-55х21 LT");
        $this->assertEquals('700/55-21',$size->getMetricName());
    }
    
    public function testAvtorosSizeGetInchName(){
        $size = new AvtorosTyreSize("600-55х21 LT");
        $this->assertEquals("46x23.5-21",$size->getInchName());
    }
*/
    
    /*    
    public function testInchSizeConstructor() {
        $this->checkSizesList($this->inch, 'InchTyreSize');
    }

    public function testInchSizeGetRadialCord(){
        $size = new InchTyreSize("31x10.5R15");
        $this->assertEquals(Tyre::CORD_RADIAL,$size->getCord());
    }
    
    public function testInchSizeGetDiagonalCord(){
        $size = new InchTyreSize("36x12.5-16");
        $this->assertEquals(Tyre::CORD_DIAGONAL,$size->getCord());
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
    
    

    
  */  
      public function testIsPneumoSize() {
        $this->assertTrue(PneumoTyreSize::checkSize("1020х420-18"));
    }

    public function testPneumoSizeConstructor() {
        $this->checkSizesList($this->pneumo, 'PneumoTyreSize');
    }

    public function testPneumoGetCord(){
        $this->setExpectedException('Exception');
        $size = new PneumoTyreSize("1020х420-18");
        //try{
        
            $size->getCord();
//            $this->assertTrue(false);
//        } catch (Exception $ex) {
//            $this->assertTrue(true);
//        }                
    }
    
   
    
     public function testExtractDiskPneumo() {
        $disk = TyreSize::parseSize("1020х420-18")->getWheel();
        $this->assertEquals(18,$disk);
    }
}