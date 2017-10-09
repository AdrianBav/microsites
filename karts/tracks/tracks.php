<?php

	/*
	--------------------------------------------------
	php
	viewTracks.php - dynamically displays track images
	--------------------------------------------------
	*/

	// if a photo has been requested in the url get its id, else use the first id
	if (isset($_GET['tid']))
		$trackID = $_GET['tid'];
	else
		$trackID = 0;


	// define variables
	$files = array();
	$filecount = 0;
	$filetype = "/\.(jpg|jpeg)$/";
	$filepath = "thumbs/";


	// scan directory for photos and add to array
	//if($handle = opendir('.'))
	if($handle = opendir($filepath))
		{
		while(false !== ($filename = readdir($handle)))
			{
			if(preg_match($filetype, $filename))
				{
				$gallery[$filecount]=$filename;
				$filecount++;
				}
		 	}

		// release handle on directory
		closedir($handle);

		// sort the gallery
		sort($gallery);
		}


	// get the image dimentions
	$dims = getimagesize($filepath . $gallery[$trackID]);


	// calculate the next photo
	if ($trackID == ($filecount - 1))
		$trackNext = 0;
	else
		$trackNext = $trackID + 1;


	// calculate the previous photo
	if ($trackID == 0)
		$trackLast = ($filecount - 1);
	else
		$trackLast = $trackID - 1;


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<title>KARTS | Karting; Addictive Racing on Turbo Sliders</title>
		<meta http-equiv='Content-Type' content='text/html;charset=utf-8' />
	  <meta name='author' content='Adrian Bavister' />
	  <meta name='generator' content='TextPad, tab spacing 2' />
	  <meta name='description' content='Karting; Addictive Racing on Turbo Sliders' />
	  <meta name='keywords' content='turbo sliders,karts' />
	  <script src="xmlExtract.js" type="text/javascript"></script>
	  <link href='../styles.css' rel='stylesheet' type='text/css' />
	</head>

	<body class="photos">

		<!-- logo and tagline -->
		<div class='kartLogo'><a href='../index.html'><img class='logo' src='../KARTS.png' alt='KARTS' height='90px' width='220px' /></a></div>
		<div class='tagline'>Karting; Addictive Racing on Turbo Sliders</div>

		<!-- menu title -->
		<div class='menuTitle'><img src="../_menus/menu04.png" alt='' height='44' width='405' /></div>

		<!-- tracks -->
		<div class='tracksBox'>
		</div>

		<!-- track details -->
		<div class='thumbTrack'>
			We have custom designed all tracks for the custom Go-Kart.<br />
			There are over 20 tracks and we still design new tracks from time to time.<br />
			<br />
			<!-- track pack -->
			<a href='KARTS_TrackPack.zip'><img src='track.png' alt='Tracks' height='32px' width='32px' /></a><br />
			<a href='KARTS_TrackPack.zip'>Download the 'KARTS Track Pack' here!</a>
			<br /><br /><br /><br />

			<span class='galtxtName'><script type="text/javascript">getName(<?php echo $trackID ?>);</script>;</span>
			<span class='galtxtCreator'>created by&nbsp;<script type="text/javascript">getCreator(<?php echo $trackID ?>);</script></span>
			<div class='galtxtChampionship'>Part of the&nbsp;<script type="text/javascript">getSprint(<?php echo $trackID ?>);</script>&nbsp;Championship.</div>
			<br />

			<!-- track thumbnail -->
			<img class='track' src=<?php echo $filepath.$gallery[$trackID] ?> alt='' <?php echo $dims[3] ?> /><br />

			<!-- track notes -->
			<div class='galtxtNotes'><script type="text/javascript">getNotes(<?php echo $trackID ?>);</script></div><br />

			<!-- navigation -->
			<a class="nav" href="tracks.php?tid=<?php echo $trackLast ?>"><img src='last.png' alt='Last Track' height='32' width='32' /></a>
			<a class="nav" href="tracks.php?tid=<?php echo $trackNext ?>"><img src='next.png' alt='Next Track' height='32' width='32' /></a>
			<div class='galtxtLink'>last&nbsp;&nbsp;&nbsp;&nbsp;next</div>
		</div>

	</body>
</html>
