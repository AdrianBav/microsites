/* 
-------------------------
javascript
index.js - for index.html 
-------------------------
*/



/* define constants and variables */
// define record headings
var REC_NAME = 0;
var REC_QUANTITY = 1;
var REC_UNITS = 2;
var REC_CARBOHYDRATE = 3;
var REC_CALORIES = 4;
var REC_SUGAR = 5;
var REC_FAT = 6;
var REC_SATURATES = 7;
var REC_SALT = 8;

// define arrays
var NAME_ARRAY = new Array("name", "quantity", "units", "carbohydrate", "calories", "sugar", "fat", "saturates", "salt");
var RDA_ARRAY = new Array(0, 0, 0, 0, 2500, 120, 95, 30, 6);

// create an XmlHttpRequest object
var objSugest = getXmlHttpRequestObject();



/* define sub routines */
// called from keypress in the search box
function searchSuggest() 
	{
	// get the search text
	var searchBox = escape(document.getElementById('txtSearch').value);
	
	// if the search box is empty, it has just been cleared, so back to defaults
	if (searchBox == 0)
		{
		hideBox();
		searchColour("white");
		btnEatDisable(true);
		btnChangeState('btnAdd', 'disabled');
		}
	
	// else, start the 'AJAX-Suggest' request
	else if (objSugest.readyState == 4 || objSugest.readyState == 0) 
		{
		objSugest.open("GET", 'xmlSuggest.php?search=' + searchBox, true);
		objSugest.onreadystatechange = handleSearchSuggest; 
		objSugest.send(null);
		}		
	}


// called when the 'AJAX-Suggest' response is returned
function handleSearchSuggest() 
	{
	if (objSugest.readyState == 4) 
		{
		// get the search text
		var searchBox = escape(document.getElementById('txtSearch').value);
		
		// clear the search suggest holder
		document.getElementById('searchSuggest').innerHTML = '';
	
		// split the response text up into the str[] array
		var str = objSugest.responseText.split("\n");

		// if the search box is not empty
		if (searchBox != 0)
			{
			if (str == "")
				{
				// no suggestions in database
				hideBox();
				searchColour("#ff9999");
				document.getElementById('hidFoodName').value = searchBox;
				btnChangeState('btnAdd', '');
				}
			else
				{
				// show suggestions
				searchColour("white");
				showBox();
				btnChangeState('btnAdd', 'disabled');
				btnEatDisable(true);
				}
			}
	
		// generate each suggest line in html
		for (i=0; i<(str.length-1); i+=2) 
			{
			var suggest =	"<div id=" + str[i] + 
										" onmouseover='javascript:suggestOver(this);' " +
										"onmouseout='javascript:suggestOut(this);' " +
										"onclick='javascript:setSearch(this.id, this.innerHTML);' " +
										"class='suggestLink'>" + 
										str[i+1] + 
										"</div>";
										
			// build up the suggestions
			document.getElementById('searchSuggest').innerHTML += suggest;
			}
		}
	}


// extract the values for the selected food item
function lookupSearch() 
	{
	if (objSugest.readyState == 4 || objSugest.readyState == 0) 
		{
		var id = document.getElementById('hidSelectedID').value;
		
		// start the 'AJAX-ExtractValues' request
		objSugest.open("GET", 'xmlExtractValues.php?record=' + id, true);
		objSugest.onreadystatechange = addEntry;
		objSugest.send(null);
		}		
	}
	

// add entry to table; called when the 'AJAX-ExtractValues' response is returned
function addEntry()
	{
	if (objSugest.readyState == 4) 
		{
		var str = objSugest.responseText.split("\n");
		var row = ((document.getElementById('btnEat').alt)*1) + 1;

		// store values in hidden holders
		document.getElementById('hid_name'+row).value = str[REC_NAME];	
		document.getElementById('hid_quantity'+row).value = str[REC_QUANTITY];
		document.getElementById('hid_units'+row).value = str[REC_UNITS];
		document.getElementById('hid_carbohydrate'+row).value = str[REC_CARBOHYDRATE];	
		document.getElementById('hid_calories'+row).value = str[REC_CALORIES];	
		document.getElementById('hid_sugar'+row).value = str[REC_SUGAR];	
		document.getElementById('hid_fat'+row).value = str[REC_FAT];	
		document.getElementById('hid_saturates'+row).value = str[REC_SATURATES];	
		document.getElementById('hid_salt'+row).value = str[REC_SALT];	

		// save the new row number
		document.getElementById('btnEat').alt = row;
		
		// copy hidden values to food table
		refreshTable();
		
		// update totals
		updateCarbTotal();
		updateRdaTotal();
		}
	}


// delete an entry from the table
function deleteFood()
	{
	var clicked = (((document.getElementById('hidHighlight').value).substr(3))*1);
	var numRows = ((document.getElementById('btnEat').alt)*1);
	var nextRow = 0;
	
	// shift everything down one row
	for (row=clicked; row<=numRows; row++)
		{
		nextRow = row + 1;
		
		document.getElementById('hid_name'+row).value = document.getElementById('hid_name'+nextRow).value;
		document.getElementById('hid_quantity'+row).value = document.getElementById('hid_quantity'+nextRow).value;
		document.getElementById('hid_units'+row).value = document.getElementById('hid_units'+nextRow).value;
		document.getElementById('hid_carbohydrate'+row).value = document.getElementById('hid_carbohydrate'+nextRow).value;
		document.getElementById('hid_calories'+row).value = document.getElementById('hid_calories'+nextRow).value;
		document.getElementById('hid_sugar'+row).value = document.getElementById('hid_sugar'+nextRow).value;
		document.getElementById('hid_fat'+row).value = document.getElementById('hid_fat'+nextRow).value;
		document.getElementById('hid_saturates'+row).value = document.getElementById('hid_saturates'+nextRow).value;
		document.getElementById('hid_salt'+row).value = document.getElementById('hid_salt'+nextRow).value;
		}			

	// reduce the row count			
	document.getElementById('btnEat').alt = (numRows - 1);
	
	// copy hidden values to food table
	refreshTable();
	
	// update totals
	updateCarbTotal();
	updateRdaTotal();
	}


// copy the values from the hidden holders to the food table
function refreshTable()
	{
	var numRows = ((document.getElementById('btnEat').alt)*1);	

	// for each row
	for (row=1; row<=(numRows+1); row++)
		{
		// clear the next empty row
		if (row == (numRows+1))
			{
			document.getElementById('rec_name'+row).innerHTML = "";
			document.getElementById('rec_quantity'+row).innerHTML = "";
			document.getElementById('rec_carbohydrate'+row).innerHTML = "";
			document.getElementById('rec_calories'+row).innerHTML = "";
			document.getElementById('rec_sugar'+row).innerHTML = "";
			document.getElementById('rec_fat'+row).innerHTML = "";
			document.getElementById('rec_saturates'+row).innerHTML = "";
			document.getElementById('rec_salt'+row).innerHTML = "";
			}
		else
			{
			// copy name
			document.getElementById('rec_name'+row).innerHTML = document.getElementById('hid_name'+row).value;

			// copy quantity, units
			var quantity = document.getElementById('hid_quantity'+row).value;
			var units = document.getElementById('hid_units'+row).value;
			document.getElementById('rec_quantity'+row).innerHTML = quantity + " " + units;

			// copy carbohydrates
			document.getElementById('rec_carbohydrate'+row).innerHTML = roundNumber(((document.getElementById('hid_carbohydrate'+row).value)), 1);

			// copy the RDAs	
			for (n=REC_CALORIES; n<=REC_SALT; n++)
				{
				var value = document.getElementById('hid_'+NAME_ARRAY[n]+row).value;

				if (value == "trace")
					document.getElementById('rec_'+NAME_ARRAY[n]+row).innerHTML = "trace";
				else
					document.getElementById('rec_'+NAME_ARRAY[n]+row).innerHTML = roundNumber((value), 1);
				}
			}
		}
		
	// clear highlights
	clearHighlights();
	}


// mouse is clicked on a row
function setHighlight(clicked)
	{
	var lastSelected = document.getElementById('hidHighlight').value;

	// ** debug values **
	//document.getElementById('dbgLastClicked').innerHTML = lastSelected;	
	//document.getElementById('dbgJustClicked').innerHTML = clicked.id;	
	// ** debug values **	
	
	if (clicked.id == lastSelected)
		{
		/* disable the already highlighted row */
		// row is already highlighted, so reset coutner
		document.getElementById('hidHighlight').value = "none";	

		// enable the quantity and delete buttons
		btnsQuantityDeleteDisabled(true);
		}
	else
		{
		/* highligh this row just clicked on */
		// clear any old highlight
		clearHighlights();

		// highlight this new row
		document.getElementById('hidHighlight').value = clicked.id;
		
		// enable the quantity and delete buttons
		btnsQuantityDeleteDisabled(false);
		}
	}


// increase/decrease the quantity of the selected item
function editQuantity(value)
	{
	var delDisabled = document.getElementById('btnDelete').disabled;

	// use the status of the delete button to enable the functionality of these buttons/links

	if (delDisabled == false)

		{
		// get the highlighted row number
		var row = (document.getElementById('hidHighlight').value).substr(3);

		// get the quantity and units
		var oldQuantity = ((document.getElementById('hid_quantity'+row).value)*1);
		var units = " " + (document.getElementById('hid_units'+row).value);

		// calculate new quantity (note: value is either a positive or negative number)
		var newQuantity = oldQuantity + value;
		
		// don't allow quantity to go to zero or below
		if (newQuantity <= 0)
			newQuantity = oldQuantity;
		else
			{
			// update the quantity
			document.getElementById('hid_quantity'+row).value = newQuantity;
			document.getElementById('rec_quantity'+row).innerHTML = newQuantity + units;

			// update the individual food record
			for (i=REC_CARBOHYDRATE; i<=REC_SALT; i++)
				{
				var currentValue = (document.getElementById('hid_'+NAME_ARRAY[i]+row).value);
				var newValue = (currentValue / oldQuantity) * newQuantity;

				if (currentValue == "trace")
					{
					// handle the 'trace' value
					document.getElementById('hid_'+NAME_ARRAY[i]+row).value = "trace";
					document.getElementById('rec_'+NAME_ARRAY[i]+row).innerHTML = "trace";
					}
				else
					{
					// update the individual record
					document.getElementById('hid_'+NAME_ARRAY[i]+row).value = newValue;
					document.getElementById('rec_'+NAME_ARRAY[i]+row).innerHTML = roundNumber(newValue, 1);
					}
				}

			// now update the totals
			updateCarbTotal();
			updateRdaTotal();
			}
		}
	}


// update the carbohydrate total
function updateCarbTotal()
	{
	var numRows = ((document.getElementById('btnEat').alt)*1);
	var total = 0;
	
	// add up all the rows
	for (n=1; n<=numRows; n++)
		{
		total += ((document.getElementById('hid_carbohydrate'+n).value)*1);
		}
		
	// output the total
	document.getElementById('total_carbohydrate').innerHTML = roundNumber(total, 1);
	
	// update the dose
	calculateMealDose();
	}


// update the RDA totals
function updateRdaTotal()
	{
	// row button points at next empty row, so subtract 1
	var numRows = ((document.getElementById('btnEat').alt)*1);

	// for each RDA
	for (i=REC_CALORIES; i<=REC_SALT; i++)
		{
		var maxRDA = RDA_ARRAY[i];
		var totalRDA = 0;

		// add up all the rows
		for (n=1; n<=numRows; n++)
			{
			var value = (document.getElementById('hid_'+NAME_ARRAY[i]+n).value);
			
			if (value != "trace")
				totalRDA = totalRDA + (value*1);
			}

		// calculate and output the RDA percentage
		document.getElementById('rda_'+NAME_ARRAY[i]).innerHTML = Math.round((totalRDA / maxRDA) * 100) + '%';

		// set text to red if over total is over the RDA maximum
		if (totalRDA > maxRDA)
			document.getElementById('rda_'+NAME_ARRAY[i]).style.color = "red";
		else
			document.getElementById('rda_'+NAME_ARRAY[i]).style.color = "black";
		}
	}
  


/* smaller functions */
// disable autocomplete on the search box
function initSearch()
	{
	document.getElementById('txtSearch').setAttribute('autocomplete', 'off');
	}
	
	
// disable autocomplete on the input boxs
function initBoxes()
	{
	document.getElementById('txtQuantity').setAttribute('autocomplete', 'off');
	document.getElementById('txtUnits').setAttribute('autocomplete', 'off');
	document.getElementById('txtCarbohydrate').setAttribute('autocomplete', 'off');
	document.getElementById('txtCalories').setAttribute('autocomplete', 'off');
	document.getElementById('txtSugar').setAttribute('autocomplete', 'off');
	document.getElementById('txtFat').setAttribute('autocomplete', 'off');
	document.getElementById('txtSaturates').setAttribute('autocomplete', 'off');
	document.getElementById('txtSalt').setAttribute('autocomplete', 'off');
	}
	

// gets the browser specific XmlHttpRequest object
function getXmlHttpRequestObject() 
	{
	var xmlHttp = null;

	try
		{
		// firefox, opera 8.0+, safari
		xmlHttp = new XMLHttpRequest();
		}
	catch (e)
		{
		// internet explorer
		try
			{
			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
			}
		catch (e)
			{
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
		}
	 
	return xmlHttp;
	}


// clear any highlighted rows
function clearHighlights()
	{
	var lastSelected = document.getElementById('hidHighlight').value;	
	
	if (lastSelected != "none")
		document.getElementById(lastSelected).className = 'rowHighlightOff';
		
	// disavle the buttons

	btnsQuantityDeleteDisabled(true);
	}


// highlight the row on mouseover event
function rowHighlight(div_value)
	{
	var numRows = ((document.getElementById('btnEat').alt)*1);
	var highlightNumber = div_value.id.substr(3);
	
	// only highlight if row exists
	if (highlightNumber <= numRows)
		div_value.className = 'rowHighlight';
	}


// de-highlight row if non-active on mouseout event
function rowHighlightOff(div_value)
	{
	if (div_value.id != document.getElementById('hidHighlight').value)
		div_value.className = 'rowHighlightOff';
	}


// mouse over function
function suggestOver(div_value) 
	{
	div_value.className = 'suggestLinkOver';
	}


// mouse out function
function suggestOut(div_value) 
	{
	div_value.className = 'suggestLink';
	}


// called when user clicks on a suggestion
function setSearch(id, name) 
	{
	// hide the suggestion box and clear the suggest area
	hideBox();
	document.getElementById('searchSuggest').innerHTML = '';

	// store the chosen suggestion id and name
	document.getElementById('hidSelectedID').value = id;	
	document.getElementById('txtSearch').value = name;

	// enable the eat button
	btnEatDisable(false);	
	}


// show the suggest box
function showBox()
	{
  document.getElementById('searchSuggest').style.display = 'block';
  btnChangeState('btnAdd', '');
	}
	
	
// hide the suggest box
function hideBox()
	{
  document.getElementById('searchSuggest').style.display = 'none';
	}


// en/disable the button
function btnChangeState(btnName, btnClass)
	{
	// alter the style of the button
	document.getElementById(btnName).className = btnClass;
	
	// physically en/disable the button
	if (btnClass == 'disabled')
		document.getElementById(btnName).disabled = true;
	else
		document.getElementById(btnName).disabled = false;
	}
	
	
// enable/disable the eat button
function btnEatDisable(value)
	{
  document.getElementById('btnEat').disabled = value;
	}
	

// change colour of search box
function searchColour(colour)
	{
  document.getElementById('txtSearch').style.backgroundColor = colour;
	}


// enable/disable the quantity and delete buttons
function btnsQuantityDeleteDisabled(disable)
	{
	if (disable == true)

		{
		// disable the buttons
		btnChangeState('linkQupHv', 'disabled');
		btnChangeState('linkQup1', 'disabled');
		btnChangeState('linkQup10', 'disabled');
		btnChangeState('linkQup20', 'disabled');
		btnChangeState('linkQup50', 'disabled');
		btnChangeState('linkQdownHv', 'disabled');
		btnChangeState('linkQdown1', 'disabled');
		btnChangeState('linkQdown10', 'disabled');
		btnChangeState('linkQdown20', 'disabled');
		btnChangeState('linkQdown50', 'disabled');
		btnChangeState('btnDelete', 'disabled');
		}
	else
		{
		// enable the buttons
		btnChangeState('linkQupHv', '');
		btnChangeState('linkQup1', 'positive');
		btnChangeState('linkQup10', 'positive');
		btnChangeState('linkQup20', 'positive');
		btnChangeState('linkQup50', 'positive');
		btnChangeState('linkQdownHv', 'negative');
		btnChangeState('linkQdown1', 'negative');
		btnChangeState('linkQdown10', 'negative');
		btnChangeState('linkQdown20', 'negative');
		btnChangeState('linkQdown50', 'negative');
		btnChangeState('btnDelete', '');
		}
	}


// used to enter 'trace' into the number boxes
function trace(chkBox) 
	{
	// get the input box id
	var txtBoxName = "txt" + chkBox.id.substr(3);
	
	// if box is checked, insert trace and disable
	if (chkBox.checked == true)
		document.getElementById(txtBoxName).value = "trace";
	else
		document.getElementById(txtBoxName).value = "";
	}	


// adjust the correction dose
function correctionDose(direction)
	{
	var correctionDose = ((document.getElementById('txtCorrectionDose').innerHTML)*1);
	
  if ((direction == 'LESS') && (correctionDose > 1))
  	document.getElementById('txtCorrectionDose').innerHTML = correctionDose - 1;
  
  else if ((direction == 'MORE') && (correctionDose < 9))
  	document.getElementById('txtCorrectionDose').innerHTML = correctionDose + 1;
  
  // refresh the dosage
  calculateCorrectionDose();	
	}	


// calculate the correction dose
function calculateCorrectionDose()
	{
	var target = ((document.getElementById('txtTarget').value)*1);
	var actual = ((document.getElementById('txtActual').value)*1);
	var correctionDose = ((document.getElementById('txtCorrectionDose').innerHTML)*1);	
	var correctionValue = ((actual - target) / correctionDose);

	//	if actual level is less than target, no correction is required
	if (actual < target)
		correctionValue = 0;

	// output the dose	
  document.getElementById('txtCorrectionUnits').innerHTML = roundNumber(correctionValue, 1);
  
  // calculate the total dose
  calculateTotalDose();
	}

	
// adjust the meal dose
function mealDose(direction)
	{
	var mealDose = ((document.getElementById('txtMealDose').innerHTML)*1);
	
  if ((direction == 'LESS') && (mealDose > 1))
  	document.getElementById('txtMealDose').innerHTML = mealDose - 1;
  
  else if ((direction == 'MORE') && (mealDose < 25))
  	document.getElementById('txtMealDose').innerHTML = mealDose + 1;
  
  // refresh the dosage
  calculateMealDose();
	}
	

// calculate the meal dose
function calculateMealDose()
	{
	var totalCarbs = ((document.getElementById('total_carbohydrate').innerHTML)*1);
	var mealDose = ((document.getElementById('txtMealDose').innerHTML)*1);	
	
	// output the dose		
  document.getElementById('txtMealUnits').innerHTML = roundNumber((totalCarbs / mealDose), 1);
  
  // calculate the total dose
  calculateTotalDose();
	}
	
	
// calculate the total dose	
function calculateTotalDose()
	{
	var correctionDose = ((document.getElementById('txtCorrectionUnits').innerHTML)*1);
	var mealDose = ((document.getElementById('txtMealUnits').innerHTML)*1);	
	
	// output the total dose		
	document.getElementById('txtTotalDose').innerHTML = roundNumber((correctionDose + mealDose), 1);
	}


// round number to specified number of decimal places
function roundNumber(num, dp) 
	{
	var result = Math.round(num*Math.pow(10,dp)) / Math.pow(10,dp);
	return result;
	}	



/* end of file */