<?php

/*
-----------------------------------
php
addToDB.php - called by addForm.php
-----------------------------------
*/


/* *** NOTE: This page is disabled. *** */
redirect("../index.php","Invalid Password!");


// password required to add to database
$admin_password = "FOOD3862";

// check password
if ($_POST['txtPassword'] != $admin_password)
	{
	redirect("../index.php","Invalid Password!");
	}


// get our database abstraction file
require('../mysqlFunctions.php');

// query the database
$qryAdd = db_query("INSERT INTO foods (name, quantity, units, carbohydrate, calories, sugar, fat, saturates, salt)
															 VALUES (
															 				'" . $_POST['txtName'] . "',
															 				" . $_POST['txtQuantity'] . ",
															 				'" . $_POST['txtUnits'] . "',
															 				" . fmtNumber($_POST['txtCarbohydrate']) . ",
															 				" . fmtNumber($_POST['txtCalories']) . ",
															 				" . fmtNumber($_POST['txtSugar']) . ",
															 				" . fmtNumber($_POST['txtFat']) . ",
															 				" . fmtNumber($_POST['txtSaturates']) . ",
															 				" . fmtNumber($_POST['txtSalt']) . "
															 				)
									");


// go back to main page
redirect("../index.php", ($_POST['txtName'] . " added to database."));






/* sub-routines */


// store trace values as a number
function fmtNumber($number)
	{
	if ($number == "trace")
		$number = -1;

	return $number;
	}



// displays message and re-directs page
function redirect($target, $message)
	{

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<title>Nutritional Information: Redirecting...</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<meta http-equiv="refresh" content="3; url=<?=$target?>">
	  <meta name="author" content="Adrian Bavister" />
	  <meta name="generator" content="TextPad, tab spacing 2" />
	  <meta name="description" content="A Database of Nutritional Information." />
	  <meta name="keywords" content="nutritional information,diabetes" />
	  <link href="add.css" rel="stylesheet" type="text/css" />
	</head>

	<body class="redirect">

		<div>
			<br /><br />
			<?=$message?>
			<br /><br />
			Please wait...
		</div>

	</body>
</html>
<?

	exit;
	}


?>