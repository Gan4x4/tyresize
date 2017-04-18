#Tyre size parser

Tyres of the same size may have different markings. The most famous is American (inch **31x10.5R16**) and European(Metric). 

Inch size specifies the height and width of the tire in inches and the inch size of the disk. For example **31x10.5R16**.

In the second case the marking includes a width in millimeters, the height of the profile of the tire in percent inch disk size: 265/75R16

In addition, a number of manufacturers mark light-truck, truck and pneumatic tires in a special way.
So for example, in Interco company width and height are swapped for som tires (**16x35-16** instead of the **35x16-16** Bogger tire B-119). A number of pneumatic wheels are marked with metric units, but do not indicate the profile: 1300x700-24
Some tires do not contain explicit information about the size of the marking for example **Q78-15** or **160m**.

This library helps to work with such a variety of markings. It can be used to create tire calculators or search the database of tires.


##Installation
The Tyre size parser can be installed with Composer. Run this command:
```sh
    composer require gan4x4/tyresize
```


##Usage

```php
<?php

/* 
 * Example of tyresize library usage
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
    // But 375/65R16 is more fat  than 36x12.5-16

    print "\nYou can use some rare marks\n";
     
    $q78 = TyreSize::parseSize("Q78-15");
    print $q78->getOriginal()." is equal to ".$q78->getInchName()."\n";
    $fullProfileTyre = TyreSize::parseSize("195R16");
    // Q78-15 is equal to 35.5x11-15
    print $fullProfileTyre->getOriginal()." is equal to ".$fullProfileTyre->getMetricName()."\n";
    // 195R16 is equal to 195/80R16
    
} catch (InvalidTyreSizeException $ex) {
    print "Invalid tyre size";
}

```
