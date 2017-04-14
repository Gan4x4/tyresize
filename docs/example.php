<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("../vendor/autoload.php");

use gan4x4\Market\Size\TyreSize;
use gan4x4\Market\Size\InvalidTyreSizeException;

try{
    
    // Call factory method that return instance  of TyreSize descendant.
    // Class of returned object depends of what type of tyre marking 
    
    
    $firstTyre = TyreSize::parseSize("36x12.5-16");  // Instance
    print "Size parsed! \n";
    
    print "This tyre width is ".$firstTyre->getMetricWidth()."mm \n"; 
    //This tyre width is 320mm 
    
    print "this tyre has profile ". $firstTyre->getProfile()."%\n"; 
    //this tyre has profile 80%
    
    print "this tyre full metric name is ".$firstTyre->getMetricName()."\n";
    //this tyre full metric name is 320/80-16
    
    print "Value of 4 tyre is ".($firstTyre->getValue()*4)." m3 \n";
    //Value of 4 tyre is 1.161288 m3 
    
    
    print "\nCompare tyres\n";
    $secondTyre = TyreSize::parseSize("375/65R16");
    
    if ($firstTyre->getInchHeigth() > $secondTyre->getInchHeigth()){   
        print $firstTyre->getOriginal()." is bigger than ".$secondTyre->getOriginal()."\n";
        
    }
    // 36x12.5-16 is bigger than 375/65R16
    
    
    if ($firstTyre->getInchWidth() < $secondTyre->getInchWidth()){   
        print "But ". $secondTyre->getOriginal()." is more fat  than ".$firstTyre->getOriginal()."\n";
    }
    //But 375/65R16 is more fat  than 36x12.5-16

    print "\nYou can use some rare marks\n";
     
    $q78 = TyreSize::parseSize("Q78-15");
    print $q78->getOriginal()." is a ".$q78->getInchName()."\n";
    $fullProfileTyre = TyreSize::parseSize("195R16");
    //Q78-15 is a 35.5x11-15
    print $fullProfileTyre->getOriginal()." is a ".$fullProfileTyre->getMetricName()."\n";
    //195R16 is a 195/80R16
    
    
    
} catch (InvalidTyreSizeException $ex) {
    print "Invalid tyre size";


}
