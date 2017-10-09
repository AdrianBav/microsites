/* 
-------------------------------------------------------------
javascript
xmlExtract.js - extracts photo information from 'gallery.xml'
-------------------------------------------------------------
*/


// create XML object
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  xml_file = new XMLHttpRequest();
  }
else
  {
  // code for IE6, IE5
  xml_file = new ActiveXObject("Microsoft.XMLHTTP");
  }


// load XML file
xml_file.open("GET","tracks.xml",false);
xml_file.send();
xmlDoc = xml_file.responseXML; 



// function to extract 'name' from XML file
function getName(tid)
	{
	var track = xmlDoc.getElementsByTagName("track");
	var trackname = track[tid].getElementsByTagName("name")[0].childNodes[0].nodeValue;

	document.write(trackname);
	}


// function to extract 'creator' from XML file
function getCreator(tid)
	{
	var track = xmlDoc.getElementsByTagName("track");
	var creator = track[tid].getElementsByTagName("creator")[0].childNodes[0].nodeValue;

	document.write(creator);
	}


// function to extract 'sprint' from XML file
function getSprint(tid)
	{
	var track = xmlDoc.getElementsByTagName("track");
	var sprint = track[tid].getElementsByTagName("championship")[0].childNodes[0].nodeValue;

	document.write(sprint);
	}


// function to extract 'notes' from XML file
function getNotes(tid)
	{
	var track = xmlDoc.getElementsByTagName("track");
	var notes = track[tid].getElementsByTagName("notes")[0].childNodes[0].nodeValue;

	document.write(notes);
	}
