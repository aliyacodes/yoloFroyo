<?php
//items4.php

//Create objects

$myItem = new Item(1,"Dark Chocolate Lovers","The Darkest Chocolate You'll Ever Experience",5.00);
$myItem->addExtra("Nuts", 0.25);
$myItem->addExtra("Mochi", 0.25);
$myItem->addExtra("Caramel Sauce", 0.25);
$config->items[] = $myItem;

$myItem = new Item(2,"Creme Brulee Vanilla","The Least Vailla Vanilla You'll Ever Taste",5.00);
$myItem->addExtra("Graham Cracker", 0.25);
$myItem->addExtra("Toffee Crunch", 0.25);
$myItem->addExtra("Oreo Cookies", 0.25);
$config->items[] = $myItem;

$myItem = new Item(2,"Peanut Butter","So Much Peanut and So Much Butter",5.00);
$myItem->addExtra("Hot Fudge", 0.25);
$myItem->addExtra("Reeces Peanut Butter Cups", 0.25);
$myItem->addExtra("Chocolate Chips", 0.25);
$config->items[] = $myItem;

$myItem = new Item(3,"Peanut Butter Mud Pie","Dark Chocolate Lovers, Creme Brulee Vanilla and Peanut Butter--All Mixed Together",15.00);
$myItem->addExtra("Chocolate Sauce", 0.25);
$myItem->addExtra("Fudge Chunks", 0.25);
$myItem->addExtra("Butter Finger Crumble", 0.25);
$config->items[] = $myItem;

//$items[] = new Item(1,"Taco","Our taco is awesome!",1.95);
//$items[] = new Item(2,"Sundae","Our sundaes are awesome!",5.95);
//$items[] = new Item(3,"Salad","Our salad is awesome!",7.95);

/**
* Item Class allows the program to create myItem objects of frozen yogurt; objects with size, price, flavor and topping properties; in an array.
* <?php $myItem = new Item(1,"Dark Chocolate Lovers","The Darkest Chocolate You'll Ever Experience",5.00); ?>
* @todo none
*/ 

// Create Class Item

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
        
        $this->Extras[][] = $extra;
        
    }// end addExtra function
    
}//end item class