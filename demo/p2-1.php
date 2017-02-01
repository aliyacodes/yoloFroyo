<?php
/**
 * p2-1.php, based on demo_postback.php, is a single page web application that allows us to request and view
 * a customer's name
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
 * @package ITC281
 * @author Bill Newman <williamnewman@gmail.com>
 * @version 1.1 2011/10/11
 * @link http://www.newmanix.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @todo finish instruction sheet
 * @todo add more complicated checkbox & radio button examples
 */

# '../' works for a sub-folder.  use './' for the root
require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials
include 'items4.php';
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
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}
else{$myAction = "";}

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
		<table align="center">
			<tr>

				<td>';

    /*

    ' . XXX . '

    */
		//Type of Froyo
  echo '
				<h2>Name</h2><br>
				<input type="text" name="yourName" />

				<h2>Size</h2><br>
				<input type="radio" name="size" value="small"> Small $1.00<br>
				<input type="radio" name="size" value="medium"> Medium $2.00<br>
				<input type="radio" name="size" value="large"> Large $3.00

				<h2>Flavor</h2><br>
				<input type="radio" name="flavor" value="choc"> Chocolate<br>
  			<input type="radio" name="flavor" value="vanilla"> Vanilla<br>
  			<input type="radio" name="flavor" value="swirl"> Swirl

				<h2>Toppings</h2><br>
				<input type="checkbox" name="toppings[]" value="peanuts">Peanuts<br>
				<input type="checkbox" name="toppings[]" value="coconut">Coconut<br>
				<input type="checkbox" name="toppings[]" value="almonds">Almonds<br>

	';

                echo '
                <!--
					<input type="text" name="YourName" /><font color="red"><b>*</b></font> <em>(alphabetic only)</em>
                    -->
				</td>
			</tr>
			<tr>
				<td align="center" colspan="2">
					<input type="submit" value="Please Enter Your Name"><em>(<font color="red"><b>*</b> required field</font>)</em>
				</td>
			</tr>
		</table>
		<input type="hidden" name="act" value="display" />
	</form>
	';
	get_footer(); #defaults to footer_inc.php
}

function showData()
{#form submits here we show entered name

    var_dump($_POST);


	get_header(); #defaults to footer_inc.php
	// if(!isset($_POST['YourName']) || $_POST['YourName'] == '')
	// {//data must be sent
	// 	feedback("No form data submitted"); #will feedback to submitting page via session variable
	// 	myRedirect(THIS_PAGE);
	// }

	// if(!ctype_alnum($_POST['YourName']))
	// {//data must be alphanumeric only
	// 	feedback("Only letters and numbers are allowed.  Please re-enter your name."); #will feedback to submitting page via session variable
	// 	myRedirect(THIS_PAGE);
	// }


		$order[] = new Item($_POST["yourName"],$_POST["size"],$_POST["flavor"],$_POST["toppings"]);
		// $order = new Item($yourName,$size,$flavor,$toppings[]);

		dumpDie($order);

	// $myName = strip_tags($_POST['YourName']);# here's where we can strip out unwanted data

	// echo '<h3 align="center">' . smartTitle() . '</h3>';
	// echo '<p align="center">Your name is <b>' . $myName . '</b>!</p>';
	// echo '<p align="center"><a href="' . THIS_PAGE . '">RESET</a></p>';
	// get_footer(); #defaults to footer_inc.php
}
?>
