<?php
//items4.php

//Create objects

$myItem = new Item(1,"Chocolate Froyo","Our Chocolate Froyo is sinful!",3.95);
$myItem->addExtra("Fudge");
$myItem->addExtra("Cocoa nibs");
$myItem->addExtra("Toasted almonds");
$config->items[] = $myItem;

$myItem = new Item(2,"Vanilla Froyo","Our Vanilla Froyo is exotic!",3.95);
$myItem->addExtra("Rainbow sprinkles");
$myItem->addExtra("Chocolate chips");
$myItem->addExtra("Strawberries");
$myItem->addExtra("Pineapple");
$myItem->addExtra("Orange Slices");
$config->items[] = $myItem;

$myItem = new Item(3,"Chocolate & Vanilla swirl Froyo","Our swirl Froyo is the best of both worlds!",3.95);
$myItem->addExtra("Chocolate Sprinkles");
$myItem->addExtra("Caramel");
$myItem->addExtra("Toasted almonds");
$myItem->addExtra("Graham cracker crumbs");
$config->items[] = $myItem;

/**
* Class Item allows the program to create myItem objects of frozen yogurt; objects with size, price, flavor and topping properties; in an array.
* <?php $myItem = new Item(1,"Chocolate Froyo","Our Chocolate Froyo is sinful!",3.95); ?>
* @todo none
*/

// Create Item Class

class Item
{
    public $ID = 0;
    public $Name = '';
    public $Description = '';
    public $Price = 0;
    public $Extras = array();

    //item constructor

    public function __construct($ID,$Name,$Description,$Price)
    {
        $this->ID = $ID;
        $this->Name = $Name;
        $this->Description = $Description;
        $this->Price = $Price;

    }#end Item constructor

    //add the array items separately

    public function addExtra($extra)
    {
        $this->Extras[] = $extra;

    }#end addExtra()



}#end Item class
