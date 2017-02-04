<?php
//items4.php

$myItem = new Item(1,"Vanilla Frozen Yogurt","Delicious, classic vanilla frozen yogurt goes with anything.",4.95);
$config->items[] = $myItem;

$myItem = new Item(2,"Chocolate Frozen Yogurt","Our chocolate is made with fair trade cocoa beans from Guatemala.",4.95);
$config->items[] = $myItem;

$myItem = new Item(3,"Seasonal Hippy Raspberry","Made exclusively from vegan raspberries",5.95);
$config->items[] = $myItem;

//move this class to another file!
class Item {
    
    public $ID = 0;
    public $Name = '';
    public $Description = '';
    public $Price = 0;
    public $Extras = array();
    
    //item constructor
    public function __construct($ID,$Name,$Description,$Price){
        
        $this->ID = $ID;
        $this->Name = $Name;
        $this->Description = $Description;
        $this->Price = $Price;        
        
    }//end item constructor
    
    //add the array items separately
    
    public function addExtra($extra){
        
        $this->Extras[] = $extra;
        
    }// end addExtra function
    
}//end item class