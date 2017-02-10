<?php
/**
 * p2-1.php, based on demo_postback_nohtml.php is a single page web application that allows us to request and view a customer's name
 *
 * This version uses no HTML directly so we can code collapse more efficiently
 *
 * This page is a model on which to demonstrate fundamentals of single page, postback
 * web applications.
 *
 * Any number of additional steps or processes can be added by adding keywords to the switch
 * statement and identifying a hidden form field in the previous step's form:
 *
 *<code>
 * <input type="hidden" name="act" value="next" />
 *</code>
 *
 * The above live of code shows the parameter "act" being loaded with the value "next" which would be the
 * unique identifier for the next step of a multi-step process
 *
 * @package ITC250
 * @author Team YoloFroyo <https://github.com/aliyacodes/yoloFroyo>
 * @version 1.0 2017/02/07
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @todo add  styling
 */

# '../' works for a sub-folder.  use './' for the root
require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials
include 'itemsP-2.php';
/*
$config->metaDescription = 'Web Database ITC281 class website.'; #Fills <meta> tags.
$config->metaKeywords = 'SCCC,Seattle Central,ITC281,database,mysql,php';
$config->metaRobots = 'no index, no follow';
$config->loadhead = ''; #load page specific JS
$config->banner = ''; #goes inside header
$config->copyright = ''; #goes inside footer
$config->sidebar1 = ''; #goes inside left side of page
$config->sidebar2 = ''; #goes inside right side of page
$config->nav1["page.php"] = "New Page!"; #add a new page to end of nav1 (viewable this page only)!!
$config->nav1 = array("page.php"=>"New Page!") + $config->nav1; #add a new page to beginning of nav1 (viewable this page only)!!
*/

//END CONFIG AREA ----------------------------------------------------------

# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

switch ($myAction)
{//check 'act' for type of process
	case "display": # 2)Display user's name!
	 	showData();
	 	break;
	default: # 1)Ask user to enter their name
	 	showForm();
}

function showForm()
{# shows form so user can enter their name.  Initial scenario
	global $config;
    get_header(); #defaults to header_inc.php

	echo
	'<script type="text/javascript" src="' . VIRTUAL_PATH . 'include/util.js"></script>
	<script type="text/javascript">
		function checkForm(thisForm)
		{//check form data for valid info
			if(empty(thisForm.YourName,"Please Enter Your Name")){return false;}
			return true;//if all is passed, submit!
		}
	</script>
	<h3 align="center">' . smartTitle() . '</h3>
	<p align="center">Please enter your name</p>
	<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">
             ';


		foreach($config->items as $item)
          {
              echo '<p><b>Qty.</b>
							<select name="item_' . $item->ID . '">
						    <option value="0">0</option>
						    <option value="1">1</option>
						    <option value="2">2</option>
						    <option value="3">3</option>
						    <option value="4">4</option>
						  </select> <b> ' . $item->Name . '</b> <i> ~ ' . $item->Description . '</i></p>';
							//dumpDie($item);

							foreach($item->Extras as $id => $toppings) {
							//dumpDie($key);
							echo '<p><input type="checkbox" value="' . $toppings . '" name="extra_' . $id . '_[]" /> ' . $toppings . ' </p>';
							//dumpDie($id);
							}

					}

          echo '
				<p>
					<input type="submit" value="Submit Order"><em>(<font color="red"><b>*</b> required field</font>)</em>
				</p>
		<input type="hidden" name="act" value="display" />
	</form>
	';
	get_footer(); #defaults to footer_inc.php
}

function showData()
{#form submits here we show entered name
	global $config;
    //dumpDie($_POST);
     get_header(); #defaults to footer_inc.php


	echo '<h3 align="center">' . smartTitle() . '</h3>';


    if(array_sum($_POST) > 0)
    {//if they ordered anything

        $runningTotal = 0;

        foreach($_POST as $name => $value)
        {//loop the form elements
            // $value is the Qty of each item.

            //if form name attribute starts with 'item_', process it
          if(substr($name,0,5)=='item_')
          {
            if ((int)$value > 0 )//cast $value into an int
            {
               //explode the string into an array on the "_"
              $name_array = explode('_',$name);

              //forcibly cast to an int in the process and "id" is the second element of the array.
              $id = (int)$name_array[1];
              // minus 1 to make id equal the correct number in items array.
              $id = $id - 1;
              //get global "items" from $config and put in $id var to call the correct one.
              $itemObj = $config->items[$id];
              //It calls an object of item. So convert to array of vars with "get_object_vars()"
              $itemArray = get_object_vars ( $itemObj );

              $total = $value * $itemArray['Price'];

              // echo $value.' '.$itemArray['Name'].' at ' . money_format('$%i', $itemArray['Price']) . ' each: ' . money_format('$%i', $total) . ' </p>';
              // $runningTotal += $total;

    				} //end cast $value into an int

        }//end inner if block

//if form name attribute starts with 'extra_1', process it
				if(substr($name,0,6)=='extra_')
				{
					//explode the string into an array on the "_"
					$name_array = explode('_',$name);
					//forcibly cast to an int in the process and "id" is the second element of the array.
					//dumpDie($name_array);
					$id = (int)$name_array[1];
					// minus 1 to make id equal the correct number in items array.
					$id = $id - 1;
					//get global "items" from $config and put in $id var to call the correct one.
					$itemObj = (array)$config->items;
					$itemObj = $itemObj[][]
					dumpDie($itemObj);
					//It calls an object of item. So convert to array of vars with "get_object_vars()"
					//$itemArray = get_object_vars ( $itemObj );

				}

				echo $value.' '.$itemArray['Name'].' with  at ' . money_format('$%i', $itemArray['Price']) . ' each: ' . money_format('$%i', $total) . ' </p>';
				$runningTotal += $total;

    }// end $_POST foreach loop

        //make variables for formatting the bill
        $subTotal = money_format('$%i', $runningTotal);
        $tax = money_format('$%i', $runningTotal*.09);
        $finalTotal = money_format('$%i', $runningTotal+$tax);

        //display the bill to user
        echo '<p>Subtotal: ' . $subTotal . '</p>';
        echo '<p>Tax: ' . $tax . '</p>';
        echo '<p>Your total: ' . $finalTotal . '</p>';

   }//end if they ordered anything
   else {//if they didn't order anything
        echo'<p>Are you an enemy of yogurt?</p>';
   }//end else

	echo '<p align="center"><a href="' . THIS_PAGE . '">RESET</a></p>';
	get_footer(); #defaults to footer_inc.php
}
?>
