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
			if(empty(thisForm.YourName,"Please Place Your Order")){return false;}
			return true;//if all is passed, submit!
		}
	</script>
	<h3 align="center">' . smartTitle() . '</h3>
	<p align="center">Please enter your name</p>
	<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">
             ';


		foreach($config->items as $item)
    {//Loop through Item Objects - getting id, name and description.
        echo '<p><b>Qty.</b>
				<select name="item_' . $item->ID . '">
			    <option value="0">0</option>
			    <option value="1">1</option>
			    <option value="2">2</option>
			    <option value="3">3</option>
			    <option value="4">4</option>
			  </select> <b> ' . $item->Name . '</b> <i> ~ ' . $item->Description . '</i></p>';

			foreach($item->Extras as $key => $toppings)
			{//Loop through topping options of each Item object.
				echo '<p><input type="checkbox" value="1" name="extra_1_' . $toppings . '_[]" /> ' . $toppings . ' </p>';
			}//End of toppings foreach loop

		}//end loop though items

  echo '
			<p>
				<input type="submit" value="Submit Order"> <em>(<font color="red"><b>*</b> required field</font>)</em>
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

		 //dumpDie($_POST);
	echo '<h3 align="center">' . smartTitle() . '</h3>';


    if(array_sum($_POST) > 0)
    { //if they ordered anything

      $runningTotal = 0 ;
			$toppingTotal = '';

      foreach($_POST as $name => $value)
      {//loop the form elements
       // $value is the Qty of each item.

        //if form name attribute starts with 'item_', process it
    		if(substr($name,0,5)=='item_')
    		{
					if ((int)$value > 0 )//if qty is greater than 0
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
						//multiply qty by price per piece
            $total = $value * $itemArray['Price'];
						//return each flavors total(qty) price/piece and total price per flavor
						echo '<p>'.$value.' '.$itemArray['Name'].' at ' . money_format('$%i', $itemArray['Price']) . ' each: ' . money_format('$%i', $total).'</p><p><b>Toppings:</b></p>';

						//Keep a running total on everything looped.
						$runningTotal += $total;

					}//end if ((int)$value > 0 )
				}//end if(substr($name,0,5)=='item_')

					//if form name attribute starts with 'item_', process it
					if(substr($name,0,7)=='extra_1')
					{//if it's a topping and starts with 'extra_1'
						if ((int)$value > 0 )
            {
						//Create a string that begins AFTER 'extra_1'.
						$strTopping = substr($name,8);
						//Replace the '_' with a space.
						$strTopping = str_replace('_',' ',$strTopping);
						//trim off spaces from beginning and end of string.
						$strTopping = trim($strTopping);

						///print each topping
						echo '<p><small><i>'. $strTopping . '</i></small></p>';
						}//end if ((int)$value > 0 )
					}//end if(substr($name,0,7)=='extra_1')

        }// end the foreach loop

        //make variables for formatting the bill
        $subTotal = $runningTotal;
        $tax = $subTotal * .09;
        $finalTotal = $subTotal + $tax;

        //display the bill to user
        echo '<br><br><p>Subtotal: ' . money_format('$%i', $subTotal) . '</p>';
        echo '<p>Tax: ' . money_format('$%i', $tax) . '</p>';
        echo '<p>Your total: ' . money_format('$%i', $finalTotal) . '</p>';

   }//end if they ordered anything
   else {//if they didn't order anything
        echo'<h2>Are you an enemy of yogurt?</h2>';
   }//end else

	echo '<p align="center"><a href="' . THIS_PAGE . '">RESET</a></p>';
	get_footer(); #defaults to footer_inc.php
}
?>
