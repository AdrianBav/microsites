<?php

/*
-----------------------------------
php
votes.php - used to count the votes
-----------------------------------
*/

// define variables
$fileVote = 'votes.txt';
$fileIPs = 'ips.txt';

// get vote from argument
$vote = $_REQUEST['vote'];


// open the votes file
$currentVotes = file($fileVote);

// read vote file contents
$array = explode("||", $currentVotes[0]);
$num = $array[0];
$total = $array[1];


// ip does not exist, so new voter
if ($vote != 9)
	{
	// calculate the new variables
	$num = $num + 1;
	$total = $total + $vote;
	$average = round(($total/$num), 1);

	// generate the new contents of the votes file
	$insertvote = $num . "||" . $total;

	// insert new counts into votes file
	$fp = fopen($fileVote, 'w');
	fputs($fp, $insertvote);
	fclose($fp);

	// add to the new contents of the ips file
	$insertIP = check_ip() . "\n";

	// insert the new ip into ips file
	$fp = fopen($fileIPs, 'a');
	fputs($fp, $insertIP);
	fclose($fp);

	// output the new results
	echo	"
			 	<br />
			 	<div>number of votes:&nbsp;" . $num . "</div>
			 	<div>average slide:&nbsp;" . $average . "&nbsp;years</div>
			 	";
	}

// ip already exists
else
	{
	// calculate the old average

	$average = round(($total/$num), 1);


	// output the old results
	echo 	"
				<br />
				<div>number of votes:&nbsp;" . $num . "</div>
			 	<div>average slide:&nbsp;" . $average . "&nbsp;years</div>
				";
	}



/* sub-routines */

// get the users ip address
function check_ip()
	{
	// check if HTTP_X_FORWARDED_FOR is ok to use, else use REMOTE_ADDR
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && eregi("^[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}$", $_SERVER['HTTP_X_FORWARDED_FOR']))
		{
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
	else
		{
		$ip = getenv('REMOTE_ADDR');
		}

	// return the ip address
	return $ip;
	}

?>
