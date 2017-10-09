<?php

/*
-----------------------------------
php
votes.php - used to count the votes
-----------------------------------
*/


// get the users ip address
$ip_address = check_ip();

// open the ips file
$allIPs = file('ips.txt');


// determine if the ip already exists in the ips file
$ipExists = false;
foreach ($allIPs as $element)
	{
	if (stristr($element, $ip_address))
		{
		$ipExists = true;
		}
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

<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>

	<head>
		<title>KARTS | Karting; Addictive Racing on Turbo Sliders</title>
		<meta http-equiv='Content-Type' content='text/html;charset=utf-8' />
	  <meta name='author' content='Adrian Bavister' />
	  <meta name='generator' content='TextPad, tab spacing 2' />
	  <meta name='description' content='Karting; Addictive Racing on Turbo Sliders' />
	  <meta name='keywords' content='turbo sliders,karts' />
	  <script src='poll.js' type='text/javascript'></script>
	  <link href='../styles.css' rel='stylesheet' type='text/css' />
	</head>

	<body>
		<!-- logo and tagline -->
		<div class='kartLogo'><a href='../index.html'><img class='logo' src='../KARTS.png' alt='KARTS' height='90px' width='220px' /></a></div>
		<div class='tagline'>Karting; Addictive Racing on Turbo Sliders</div>

		<!-- menu title -->
		<div class='menuTitle'><img src="../_menus/menu02.png" alt='' height='42px' width='405px' /></div>

		<!-- about -->
		<div class='aboutBox'>
			Welcome to the KARTS official website.<br />
			'KARTS' is series of Turbo Sliders championships designed around Go-Kart racing.<br />
			<br />
			Instead of using the default Turbo Slider cars and tracks,
			we race with a custom designed kart and an array of custom designed tracks.<br />
			<br />
			You can find links on this website to download our cars and tracks.<br />
			Enjoy!
		</div>

		<!-- how long u slide? -->
		<div class='pollBox'>
			poll: how long u slide?<br /><br />

<?php
			// ip does not exist so display the voting form
			if (!$ipExists)
				{
				echo 	"
							<form>
								<select id='selYears'>
									<option value='0'>Under a Year</option>
									<option value='1'>About a Year</option>
									<option value='2'>Around 2 Years</option>
									<option value='3'>Around 3 Years</option>
									<option value='4'>Around 4 Years</option>
									<option value='5'>Around 5 Years</option>
									<option value='6'>Around 6 Years</option>
									<option value='7'>Around 7 Years</option>
									<option value='8'>From the Start</option>
								</select>
								<input type='button' id='btnVote' value='Vote' onclick='getVote(selYears.value)'></input>
							</form>
							";
				}

			// ip already exists, so just display the current results
			else
				{
				echo "our records show you have already voted.";
				echo "<script type='text/javascript'>getVote(9);</script>";
				}
?>
			<!-- results from form will go here -->
			<div id='pollResult'></div>
		</div>

	</body>
</html>