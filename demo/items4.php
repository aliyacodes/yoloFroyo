<?php
//items4.php

$myItem = new Item(1,"Taco","Our taco is awesome!",1.95);
$myItem->addExtra("Sour Cream");
$myItem->addExtra("Cheese");
$myItem->addExtra("Hot Sauce");
$config->items[] = $myItem;

$myItem = new Item(2,"Sundae","Our sundae is awesome!",6.95);
$myItem->addExtra("Chocolate Sauce");
$myItem->addExtra("Cherries");
$myItem->addExtra("Sprinkles");
$config->items[] = $myItem;

$myItem = new Item(3,"Salad","Our salad is awesome!",4.95);
$myItem->addExtra("Lemon");
$myItem->addExtra("Salmon");
$myItem->addExtra("Croutons");
$myItem->addExtra("Bacon");
$config->items[] = $myItem;

//$items[] = new Item(1,"Taco","Our taco is awesome!",1.95);
//$items[] = new Item(2,"Sundae","Our sundaes are awesome!",5.95);
//$items[] = new Item(3,"Salad","Our salad is awesome!",7.95);



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