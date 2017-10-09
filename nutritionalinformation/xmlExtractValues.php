<?php

/*
-----------------------------------------
php
xmlExtractValues.php - called by index.js
-----------------------------------------
*/


// get our database abstraction file
require('mysqlFunctions.php');


// check that the food_id is not empty
if (isset($_GET['record']) && $_GET['record'] != '')
	{
	// get the food_id
	$id = $_GET['record'];

	// use the food_id to extract all the values for that food
	$qryFood = db_query("SELECT * FROM foods WHERE food_id ='" . $id . "'");
	$values = db_fetch_array($qryFood);

	// format the number values
	$values = formatNumbers($values);

	// build the responce
	echo 	$values['name'] . "\n" .
				$values['quantity'] . "\n" .
				$values['units'] . "\n" .
				$values['carbohydrate'] . "\n" .
				$values['calories'] . "\n" .
				$values['sugar'] . "\n" .
				$values['fat'] . "\n" .
				$values['saturates'] . "\n" .
				$values['salt'] . "\n";
	}




/* sub-routiens */
// format any numbers in the array
function formatNumbers($numbers)
	{
	// remove any point zeros
	$numbers['quantity'] = $numbers['quantity'] + 0;
	$numbers['carbohydrate'] = $numbers['carbohydrate'] + 0;
	$numbers['calories'] = $numbers['calories'] + 0;
	$numbers['sugar'] = $numbers['sugar'] + 0;
	$numbers['fat'] = $numbers['fat'] + 0;
	$numbers['saturates'] = $numbers['saturates'] + 0;
	$numbers['salt'] = $numbers['salt'] + 0;


	// replace the -1 with trace
	if ($numbers['carbohydrate'] == -1)
		$numbers['carbohydrate'] = "trace";
	if ($numbers['calories'] == -1)
		$numbers['calories'] = "trace";
	if ($numbers['sugar'] == -1)
		$numbers['sugar'] = "trace";
	if ($numbers['fat'] == -1)
		$numbers['fat'] = "trace";
	if ($numbers['saturates'] == -1)
		$numbers['saturates'] = "trace";
	if ($numbers['salt'] == -1)
		$numbers['salt'] = "trace";

	// return the numbers array
	return $numbers;
	}


?>