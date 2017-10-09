<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<title>Matt and Rachel's Wedding Website</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	  <meta name="author" content="Adrian Bavister" />
	  <meta name="generator" content="TextPad, tab spacing 2" />
	  <meta name="description" content="Matt and Rachel's Wedding Website" />
	  <meta name="keywords" content="wedding,matt,rachel" />
	  <link href="../styles.css" rel="stylesheet" type="text/css" />
	</head>

	<body>
		<!-- php code, to send the e-mail -->
		<?php
			// get the player identity
			$guest = htmlspecialchars($_POST['txtName']);

			// build the e-mail message
			$message =
			"Matt/Rachel,\n\n" .
			"From: " . htmlspecialchars($_POST['txtName']) . "\n" .
			"E-Mail: " . htmlspecialchars($_POST['txtEmail']) . "\n" .
			"Message: " . htmlspecialchars($_POST['txtMessage']);

			// send the e-mail
			mail("rachie.c@excite.com", "Wedding Website: Contact Us", $message, "From: $guest");
		?>

		<!-- thank you text -->
		<div>
			<br />Thank you contacting us.
			<br />We shall get back to you shortly...<br /><br />
		</div>

		<!-- back button -->
		<form action="contact.html" method="get">
			<div><input name="btnBack" type="submit" value="Back" /></div>
		</form>
	</body>
</html>