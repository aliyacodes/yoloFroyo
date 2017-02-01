<?php
//items4.php

// $myItem = new Item(1,"Taco","Our taco is awesome!",1.95);
// $myItem->addTopping("Sour Cream");
// $myItem->addTopping("Cheese");
// $myItem->addTopping("Hot Sauce");
// $config->items[] = $myItem;
//
// $myItem = new Item(2,"Frozen Yogurt","Our yogurt is awesome!",6.95);
// $myItem->addTopping("Peanuts");
// $myItem->addTopping("Coconuts");
// $myItem->addTopping("Almonds");
// $config->items[] = $myItem;
//
// $myItem = new Item(3,"Salad","Our salad is awesome!",4.95);
// $myItem->addTopping("Lemon");
// $myItem->addTopping("Salmon");
// $myItem->addTopping("Croutons");
// $myItem->addTopping("Bacon");
// $config->items[] = $myItem;

//$items[] = new Item(1,"Taco","Our taco is awesome!",1.95);
//$items[] = new Item(2,"Sundae","Our sundaes are awesome!",5.95);
//$items[] = new Item(3,"Salad","Our salad is awesome!",7.95);



class Item {

    //public $ID = 0;
    public $YourName = '';
    public $Size = '';
    public $Flavor = '';
    public $Toppings = array();

    //item constructor $YourName,$size,$flavor,$toppings[]
    public function __construct($yourName,$size,$flavor,$toppings){

        //$this->ID = $ID;
        $this->YourName = $yourName;
        $this->Size = $size;
        $this->Flavor = $flavor;
        $this->Toppings = $toppings;



    }//end item constructor

    //add the array items separately
    // public function addTopping($topping){
    //
    //     $this->Toppings[] = $topping;
    //
    // }// end addTopping function

}//end item class
