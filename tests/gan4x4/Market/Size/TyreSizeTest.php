<?php
    namespace gan4x4\Tests\Market\Size;
    use gan4x4\Market\Size\TyreSize;
    use gan4x4\Market\Size\InvalidTyreSizeException;
    
    define("ORIGINAL",0);
    define("METRIC",1);
    define("INCH_H",2);
    define("INCH_W",3);
    define("DISK",4);
    define("METRIC_W",5);
    define("METRIC_H",6);


    class TyreSizeTest extends \PHPUnit_Framework_TestCase {
        protected $originalNamespace = "gan4x4\Market\Size";
        protected $inch = array(
            array("31x10.5R15","265/75R15",31,10.5,15,265,75),
            array("33x12.5 R16.5","320/65 R16.5",33,12.5,16.5,320,65)
            );
        
        protected $metric = array(
            array("215/75R15","27.5x8.5 R15",27.5,8.5,15,215,75),
            array("305/70 R16","33x12 R16",33,12,16,305,70)
            );
        
        protected $pneumo = array(
            array("1100х400-20","-",43.5,15.5,20,400,75),
            array("1150х620-22,5","-",45.5,24.5,22,620,50)
            );

        protected $fullsize = array(
            array("195R16","195/80R16",28.5,7.5,16,195,80),
            );
        
        protected $inchfullsize = array(
            array("7.50-16","",28,7.5,16,190,80),
        );
        
        protected $american = array(
            array("Q78-16","",35.5,11,16,280,90),
            array("Q78-15","",35.5,11,15,280,95)
            );

        protected $reverse = array(
            array("15/39.5-16.5","",39.5,15,16.5,380,75),
            array("19.5/44 -16.5LT","",44,19.5,16.5,495,70)
            );
        
        protected $custom = array(
            array("160","",36.5,12.5,16,315,85)
            
            );
        
        
    protected function setUp() {
       
    }

    protected function tearDown() {
          
    }

    // ==================== helpers =======================================
     protected function checkSizesList($list,$class){
        $class = $this->originalNamespace.'\\'.$class;
        foreach ($list as $size){
            assert(count($size) == 7 );
            $inch_size = new $class($size[ORIGINAL]);
            $add = "failed in $class for ". $size[ORIGINAL];
            $this->assertEquals($size[INCH_H],$inch_size->getInchHeigth(),"Inch H ".$add);
            $this->assertEquals($size[INCH_W],$inch_size->getInchWidth(),"Inch W failed ".$add);
            $this->assertEquals($size[DISK],$inch_size->getWheel(),"Disk failed ".$add);
            $this->assertEquals($size[METRIC_H],$inch_size->getProfile(),"Cm H failed ".$add);
            $this->assertEquals($size[METRIC_W],$inch_size->getMetricWidth(),"Cm W failed ".$add);
        }
    }
   
    
    protected function assertClassesEqual($expected,$actual){
        $this->assertEquals($this->originalNamespace.'\\'.$expected,$actual);
    }
    
   // ==================== end helpers ====================================

    
 
    
    public function testFactoryMetric() {
        $size = TyreSize::parseSize('215/75R15');
        $this->assertTrue(is_object($size));
        $this->assertClassesEqual('MetricTyreSize',get_class($size));
        
    }

    public function testFactoryInch() {
        $size = TyreSize::parseSize('35/12.50R15LT');
        $this->assertClassesEqual('InchTyreSize',get_class($size));
        
    }
    
    public function testFactoryPneumo() {
        $size = TyreSize::parseSize("1020х420-22.5");
        $this->assertClassesEqual('PneumoTyreSize',get_class($size));
        
        $size2 = TyreSize::parseSize('1700х750-26');
        $this->assertClassesEqual('PneumoTyreSize',get_class($size2));
    }

    
    public function testFactoryFullSize() {
        $size = TyreSize::parseSize("195R16");
        $this->assertClassesEqual('FullProfileTyreSize',get_class($size));
    }

    public function testFactoryAmerican() {
        $size = TyreSize::parseSize('Q78-16');
        $this->assertClassesEqual('AmericanTyreSize',get_class($size));
    }
    
    public function testFactoryReverseInch() {
        $size = TyreSize::parseSize('15/38.5-16.5');
        $this->assertClassesEqual('ReverseInchTyreSize',get_class($size));
    }
    
    public function testFactoryAvtoros() {
        $size = TyreSize::parseSize('600-55х21 LT');
        $this->assertClassesEqual('AvtorosTyreSize',get_class($size));
    }
    
    public function testConstructorNegative() {
        $this->setExpectedException($this->originalNamespace.'\InvalidTyreSizeException');        
        TyreSize::parseSize('blablabla');
    }
    
}