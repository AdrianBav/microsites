/* 
-----------------------
javascript
poll.js - for about.php
-----------------------
*/


// gets the votes
function getVote(n)
	{
	// create XML object
	if (window.XMLHttpRequest)
		{
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
		}
	else
		{
		// code for IE6, IE5
		xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
		}

	// insert response
	xmlhttp.onreadystatechange=function()
		{
		if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
			{
			document.getElementById('pollResult').innerHTML = xmlhttp.responseText;
			}
		}
		
	// call php page
	xmlhttp.open('GET','votes.php?vote='+n, true);
	xmlhttp.send();
	
	// disable voting objects
	document.getElementById('selYears').disabled = 'true';
	document.getElementById('btnVote').disabled = 'true';
	}
