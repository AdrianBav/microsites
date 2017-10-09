/* 
-------------------------
javascript
links.js - for links.html
-------------------------
*/


// calls the function when the page loads
window.onload = externalLinks;


// opens links in a new window
function externalLinks() 
	{ 
	if (!document.getElementsByTagName) 
		return; 
	

	var anchors = document.getElementsByTagName("a"); 
	

	for (var i=0; i<anchors.length; i++) 
		{ 
		var anchor = anchors[i]; 
	 	if (anchor.getAttribute("href") && anchor.getAttribute("rel") == "external") 
		 anchor.target = "_blank"; 
		} 
	} 
