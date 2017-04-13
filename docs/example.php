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
    
    $tyreSize = TyreSize::parseSize("36x12.5-16");  // Instance
    
    
    print $tyreSize->getCm_H(); // Return metric heigth of a tyre
    print $tyreSize->getCm_W(); // Return metric width of a tyre 
    
    // Convert to metric size
    
    print $tyreSize->getMetricName();
    
} catch (InvalidTyreSizeException $ex) {
    print "Invalid tyre size";


}
