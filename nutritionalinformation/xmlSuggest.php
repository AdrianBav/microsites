<?php

/*
-----------------------------------
php
xmlSuggest.php - called by index.js
-----------------------------------
*/


// send some headers to keep the users browser from caching the response
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache" );
header("Content-Type: text/xml; charset=utf-8");

// get our database abstraction file
require('mysqlFunctions.php');


// check that search is not empty
if (isset($_GET['search']) && $_GET['search'] != '')
	{
	// add slashes to any quotes to avoid SQL problems ** done by default? **
	$search = addslashes($_GET['search']);

	// query the database
	$qryFood = db_query("SELECT food_id, name FROM foods WHERE name like('%" . $search . "%') LIMIT 8");

	// build the responce
	while ($values = db_fetch_array($qryFood))
		{
		echo $values['food_id'] . "\n" . $values['name'] . "\n";
		}
	}

?>