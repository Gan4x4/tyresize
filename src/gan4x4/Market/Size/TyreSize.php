<?php

namespace gan4x4\Market\Size;
use gan4x4\Market\Size;

abstract class  TyreSize extends Size{
    const CORD_RADIAL = 'Радиальная';
    const CORD_DIAGONAL = 'Диагональная';
    static $cords = array('D'=>self::CORD_DIAGONAL,'-'=>self::CORD_DIAGONAL,'R'=>self::CORD_RADIAL);
    protected $matches;
    protected $type = false;
    protected $heigth = 0; // inch
    protected $width = 0;  // inch
    protected $disk = 0;   // inch
    protected $cord = null;   
    
    abstract function getClearOriginal();
    
    protected function __construct($original) {
        if (! static::checkSize($original)){
            throw new \Exception ("Invalid size in ".get_class($this));
        }
        parent::__construct($original);
    }
    
    // Factory
    public static function parseSize($originalSize){
        $object = null;
        $childrens = array ('Metric','Inch','Pneumo','FullProfile','FullProfileInch','American','ReverseInch','Avtoros','MetricDisk');
        $found = array();
        $calledClass = get_called_class();
        $namespaceEnd = strrpos($calledClass, '\\');
        if ($namespaceEnd > 0){
            $namespaceEnd ++;
        }
        foreach ($childrens as $child){
            $subClass = substr_replace($calledClass, $child, $namespaceEnd, 0);
            if ($subClass::checkSize($originalSize)){
                $object = new $subClass($originalSize);
                $found[] = $object;
            }
        }
        
        if (count($found) > 1 ){
             throw new \Exception("Size compatible more than one types :".$originalSize);
        }
        
        if ($object == false){
            throw new \Exception("Unknown size :".$originalSize);
        }
        return $object;
        
    }
    
    
    // helper functions
    public static function getFloat($str){
        $noComma = strtr($str,',','.');
        return floatval($noComma);
    }

    public static function truncateFloat($number){
        return number_format((float)$number, 1, '.', '');
    }

    public static function round5Int($name1){
        $c1="_".$name1; // analog of strval
	$last_d=substr($c1,-1,1);
	$summ=0;
	if ($last_d<3) {
            $nlast=0;
        }
	if ( ($last_d>2) && ($last_d<8) ) {
            $nlast=5;
        }
	if ( ($last_d>7) ) {
            $nlast=0;
            $summ=10;
        }
	$c2=substr($c1,1,count($c1)-2).$nlast;
	$c2=$c2+$summ;
	return $c2;
    }
    
    public static function round5Float($float){
        $delta = 0.1;
        if (abs((round($float) - $float)) < $delta){
            return intval($float);
        }
        else{
            $preparedNumber = round($float*10);
            $goodNumber = self::round5Int($preparedNumber);
            return self::truncateFloat($goodNumber/10);
        }
    }
    //==================== end helper ========================================
    
    
    protected function getHeigth()
    {
        return $this->heigth;
    }
    
    protected function getWidth()
    {
        return $this->width;
    }
    
    public function getDisk()
    {
        return $this->disk;
    }
    
    // synonim of getCm_H()
    public function getProfile(){
        return $this->getCm_H();        
    }
    public function getCm_H()
    {
        $h = floatval($this->getHeigth());
        $w = floatval($this->getWidth());
        $d = floatval($this->getDisk());
        
        $profileH = ($h-$d)/2;
        $percentOfW = round(100*$profileH/$w);
        return  self::round5Int($percentOfW);
        
    }
    
    // synonim 
    public function getMetricWidth(){
        return $this->getCm_W();        
    }
    
    public function getCm_W()
    {
        $w = round($this->getWidth()*self::INCH);
        return self::round5Int($w);
    }
    
    
    public function getInch_H()
    {
        $h =  $this->getHeigth();
        return self::round5Float($h);
    }
    
    public function getInch_W()
    {
        return self::round5Float($this->getWidth());
    }
    
    
    public function getMetricName(){
        $w =  self::round5Int(round($this->getWidth()*self::INCH));
        $profil = (self::INCH*($this->getHeigth() - $this->getDisk())/2);
        $percent = self::round5Int(round($profil*100/$w));
        $cordSym =  self::getCordSymbol($this->getCord());
        $d = $this->getDisk();
        return $w.'/'.$percent.$cordSym.$d;
    }
    
    public function getInchName(){
        $h =  self::round5Float($this->getHeigth());
        $w =  self::round5Float($this->getWidth());
        $cordSym =  self::getCordSymbol($this->getCord());
        $d = $this->getDisk();
        return $h.'x'.$w.$cordSym.$d;
    }
    
    public function getCord()
    {
        if ($this->cord != null){
            return $this->cord;
        }
        else{
            throw new \Exception("Can not get cord type from this size name");
        }

    }
    
    protected function validateHeigth(){
        $h = $this->getHeigth();
        if ( $h < 25 || $h > 100){
            throw new \Exception("Bad heigth :".$h);
        }
    }
    
    protected function validateWidth(){
        $w = $this->getWidth();
        if ($w < 5 || $w > 50){
            throw new \Exception("Bad Width :".$w);
        }
    }
    
    protected function validateDisk(){
        $d = $this->getDisk();
        if ($d < 4 && $d > 15){
            throw new \Exception("Bad Disk :".$d);
        }
    }

    public function Validate(){
        $this->validateHeigth();
        $this->validateWidth();
        $this->validateDisk();
    }
    
    
    public static function checkSize($inchSize,&$matches = null){
        return preg_match(static::$pattern, $inchSize,$matches) == 1; // Late static binding work !
    }

    public static function getCordSymbol($type){
        assert(in_array($type, self::$cords)); 
        $cordsFlipped =  array_flip(self::$cords);
        return $cordsFlipped[$type]; 
    }
    
    public static function getCordFromDelim($delim){
        $clearDelim = trim($delim);
        assert(in_array($clearDelim, array_keys(self::$cords)));
        return self::$cords[$clearDelim];
    }
    
    private function replaceDelimetrs($name,$cordReplacer = '_'){
        $replacePairs = array();
        $toUnderline = array('x','х','/','u','*',',',"\\",".");
        foreach ($toUnderline as $from){
            $replacePairs[$from] = '_';
        }
        $cordSymbols = array_keys(self::$cords);
        foreach ($cordSymbols as $from){
            $replacePairs[$from] = $cordReplacer;
        }
        return strtr($name,$replacePairs);
    }
    
    public function getSqlSearchPattern(){
        $name = $this->getClearOriginal();
        $shortCordReplace = $this->replaceDelimetrs($name);
        $doubleCordReplace = $this->replaceDelimetrs($name,'__');
        $tripleCordReplace = $this->replaceDelimetrs($name,'___');  
        return array($shortCordReplace,$doubleCordReplace,$tripleCordReplace);
    }
    
    
     public function getValue(){
        $w = $this->getInch_W()*self::INCH/1000; //in m3
        $h = $this->getInch_H()*self::INCH/1000;
        return $w*$h;
        //*$this->getInch_W()*self::INCH/10000;
    }
    
}
