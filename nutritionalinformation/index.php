<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<title>Nutritional Information</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	  <meta name="author" content="Adrian Bavister" />
	  <meta name="generator" content="TextPad, tab spacing 2" />
	  <meta name="description" content="A Database of Nutritional Information." />
	  <meta name="keywords" content="nutritional information,diabetes" />
	  <link rel="icon" type="image/x-icon" href="favicon.ico">
	  <link href="styles4c.css" rel="stylesheet" type="text/css" />
	  <link href="buttons/buttons.css" rel="stylesheet" type="text/css" />
	  <script src="ni.js" type="text/javascript"></script>
	</head>

	<body onload="initSearch()">

		<!-- logo and titles -->
		<table class="tblTitle">
			<tr>
				<td class="tdTitle1">
					&nbsp;
					<img class="logo" src="logo.png" alt="Return to Main Menu" height="98" width="107" />
				</td>
				<td class="tdTitle2">
					<div class="title">Nutritional Information</div>
					<div class="subTitle">beta version 1.3</div>
				</td>
				<td>&nbsp;</td>
			</tr>
		</table>
		<div><br /></div>

		<!-- this table is used as a place holder -->
		<table class="tblHolder">
			<tr>

				<!-- ** holds the search/suggest box ** -->
				<td class="cellSearch">
					<form action="javascript:lookupSearch();">
						<!-- search controls -->
						<div>
							Search for your food here...<br />
							<input type="text" id="txtSearch" name="txtSearch" alt="Search Criteria" onkeyup="searchSuggest(); " disabled />
							<input type="submit" id="btnEat" name="btnEat" value="Eat" alt="0" disabled="disabled" />
						</div>

						<!-- suggest area -->
						<div id="searchSuggest"></div>

						<!-- hidden element to hold the suggested food id -->
						<div>
							<input type="hidden" id="hidSelectedID" name="hidSelectedID" value="0" />
						</div>
					</form>
				</td>

				<!-- ** holds the food table ** -->
				<td class="cellFood" rowspan="2">

					<!-- nutrients table -->
					<table class="foodTable">
						<tr>
							<td class="cellF1"><b>food</b></td>
							<td class="cellF2"><b>quantity</b></td>
							<td class="cellF3"><b>carbohydrate</b></td>
							<td class="cellF4"><b>calories</b></td>
							<td class="cellF5"><b>sugar</b></td>
							<td class="cellF6"><b>fat</b></td>
							<td class="cellF7"><b>saturates</b></td>
							<td class="cellF8"><b>salt</b></td>
						</tr>
<?php

		// define the maximum number of entrys
		$maxRows = 20;

		// dynamically generate record holders
		for ($n=1; $n<=$maxRows; $n++)
			{
			echo "
						<tr id=\"row$n\" onmouseover='javascript:rowHighlight(this);' onmouseout='javascript:rowHighlightOff(this);' onclick='javascript:setHighlight(this);'>
							<!-- visable record holders -->
							<td><div id=\"rec_name$n\"></div></td>
							<td><div id=\"rec_quantity$n\"></div></td>
							<td><div id=\"rec_carbohydrate$n\"></div></td>
							<td><div id=\"rec_calories$n\"></div></td>
							<td><div id=\"rec_sugar$n\"></div></td>
							<td><div id=\"rec_fat$n\"></div></td>
							<td><div id=\"rec_saturates$n\"></div></td>
							<td><div id=\"rec_salt$n\"></div></td>
						</tr>
						<tr>
							<!-- hidden record holders -->
							<td><input type='hidden' id=\"hid_name$n\"></td>
							<td><input type='hidden' id=\"hid_quantity$n\"></td>
							<td><input type='hidden' id=\"hid_units$n\"></td>
							<td><input type='hidden' id=\"hid_carbohydrate$n\"></td>
							<td><input type='hidden' id=\"hid_calories$n\"></td>
							<td><input type='hidden' id=\"hid_sugar$n\"></td>
							<td><input type='hidden' id=\"hid_fat$n\"></td>
							<td><input type='hidden' id=\"hid_saturates$n\"></td>
							<td><input type='hidden' id=\"hid_salt$n\"></td>
						</tr>
					";
			}

?>
					</table>
				</td>
			</tr>

			<tr>
				<!-- ** holds the edit item controls ** -->
				<td class="cellEdit">

					<!-- increase quantity links -->
					<form action="">
						<div class="txtEdit">edit the quantity:<br /></div>
						<div class="buttons">
							<a href="javascript:editQuantity(0.5)" class="disabled" id="linkQupHv" name="linkQupHv"><img src="buttons/plus.png" alt="" />0.5</a>
							<a href="javascript:editQuantity(1)" class="disabled" id="linkQup1" name="linkQup1"><img src="buttons/plus.png" alt="" />1</a>
							<a href="javascript:editQuantity(10)" class="disabled" id="linkQup10" name="linkQup10"><img src="buttons/plus.png" alt="" />10</a>
							<a href="javascript:editQuantity(20)" class="disabled" id="linkQup20" name="linkQup20"><img src="buttons/plus.png" alt="" />20</a>
							<a href="javascript:editQuantity(50)" class="disabled" id="linkQup50" name="linkQup50"><img src="buttons/plus.png" alt="" />50</a>
							<br /><br /><br /><br />
						</div>

						<!-- reduce quantity links -->
						<div class="buttons">
							<a href="javascript:editQuantity(-0.5)" class="disabled" id="linkQdownHv" name="linkQdownHv"><img src="buttons/minus.png" alt="" />0.5</a>
							<a href="javascript:editQuantity(-1)" class="disabled" id="linkQdown1" name="linkQdown1"><img src="buttons/minus.png" alt="" />1</a>
							<a href="javascript:editQuantity(-10)" class="disabled" id="linkQdown10" name="linkQdown10"><img src="buttons/minus.png" alt="" />10</a>
							<a href="javascript:editQuantity(-20)" class="disabled" id="linkQdown20" name="linkQdown20"><img src="buttons/minus.png" alt="" />20</a>
							<a href="javascript:editQuantity(-50)" class="disabled" id="linkQdown50" name="linkQdown50"><img src="buttons/minus.png" alt="" />50</a>
							<br /><br /><br /><br />
						</div>

						<!-- hidden elements to hold RDA totals -->
						<div>
							<input type="hidden" id="hidCalories" name="hidCalories" alt="0" />
							<input type="hidden" id="hidSugar" name="hidSugar" alt="0" />
							<input type="hidden" id="hidFat" name="hidFat" alt="0" />
							<input type="hidden" id="hidSaturates" name="hidSaturates" alt="0" />
							<input type="hidden" id="hidSalt" name="hidSalt" alt="0" />

							<!-- hidden element to hold name of row that is highlighted -->
							<input type="hidden" id="hidHighlight" name="hidHighlight" value="none" />
						</div>

						<!-- remove item button -->
						<div class="buttons">
							<button type="button" class="disabled" id="btnDelete" name="btnDelete" onclick="javascript:deleteFood();" disabled="disabled">
								<img src="buttons/bin.png" alt="" />&nbsp;Remove Item from Table
							</button>
						</div>
					</form>
					<br /><br /><br /><br />

					<!-- add an entry to the database -->
					<form action="add/addForm.php" method="post">
						<div class="buttons">

							<input type="hidden" id="hidFoodName" name="hidFoodName" />

							<button type="submit" class="disabled" id="btnAdd" name="btnAdd" disabled="disabled">
								<img src="buttons/asterisk.png" alt="" />&nbsp;Add Food to Database &gt;&gt;&gt;
							</button>

						</div>
					</form>
				</td>
			</tr>

			<tr>
				<td>&nbsp;</td>

				<!-- ** holds the calculated totals ** -->
				<td class="cellTotals">
					<table class="foodTable">
						<tr>
							<td class="cellF1n2"><b>totals</b></td>
							<td class="cellF3"><div id="total_carbohydrate">0</div></td>
							<td class="cellF4"><div id="rda_calories">0%</div></td>
							<td class="cellF5"><div id="rda_sugar">0%</div></td>
							<td class="cellF6"><div id="rda_fat">0%</div></td>
							<td class="cellF7"><div id="rda_saturates">0%</div></td>
							<td class="cellF8"><div id="rda_salt">0%</div></td>
						</tr>
					</table>
				</td>
			</tr>

			<!-- ** spacers ** -->
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>

			<tr>
				<!-- ** holds the dosage calculations ** -->
				<td class="cellDose" colspan="2">
					<form action="">

						<!-- target and actual blood/glucose values -->
						<table class="doseCenter">
							<tr>
								<td class="doseLeft">target</td>
								<td>&nbsp;</td>
								<td class="doseLeft">actual</td>
							</tr>
							<tr>
								<td><input class="txtSugars" type="text" id="txtTarget" name="txtTarget" value="5.5" maxlength="4" onchange="javascript:calculateCorrectionDose();" />mmols</td>
								<td>&nbsp;</td>
								<td><input class="txtSugars" type="text" id="txtActual" name="txtActual" value="5.5" maxlength="4" onchange="javascript:calculateCorrectionDose();" />mmols</td>
							</tr>
						</table>

						<!-- dose text -->
						<div>
							<br />

							<!-- correction calculations -->
							take <span id="txtCorrectionUnits">0</span> units of insuline for correction, if one unit covers
							<input type="button" class="btnDose" id="btnCorrectionLess" name="btnCorrectionLess" value="&lt; less" onclick="javascript:correctionDose('LESS');" />
							<span id="txtCorrectionDose">3</span>
							<input type="button" class="btnDose" id="btnCorrectionMore" name="btnCorrectionMore" value="more &gt;" onclick="javascript:correctionDose('MORE');" />
							mmols of error.
							<br /><br />

							<!-- meal coverage calculations -->
							if one unit covers
							<input type="button" class="btnDose" id="btnMealLess" name="btnMealLess" value="&lt; less" onclick="javascript:mealDose('LESS');" />
							<span id="txtMealDose">14</span>
							<input type="button" class="btnDose" id="btnMealMore" name="btnMealMore" value="more &gt;" onclick="javascript:mealDose('MORE');" />
							grams of carbohydrate, take <span id="txtMealUnits">0</span> units of insuline to cover this meal.
							<br /><br />
							<span class="txtDose">suggest <span id="txtTotalDose">0</span> units to cover correction and meal</span>

						</div>
					</form>

				</td>
			</tr>

		</table>

		<!-- debug values
		<br /><br />
		<span class="dgb">clicked on: <span id="dbgLastClicked">none</span></span><br />
		<span class="dgb">just clicked: <span id="dbgJustClicked" class="dgb">none</span></span>
		-->

	</body>
</html>
