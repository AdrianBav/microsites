<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<title>Nutritional Information: Add to Database</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	  <meta name="author" content="Adrian Bavister" />
	  <meta name="generator" content="TextPad, tab spacing 2" />
	  <meta name="description" content="A Database of Nutritional Information." />
	  <meta name="keywords" content="nutritional information,diabetes" />
	  <link href="add.css" rel="stylesheet" type="text/css" />
	  <link href="../buttons/buttons.css" rel="stylesheet" type="text/css" />
	  <script src="../ni.js" type="text/javascript"></script>
	</head>

	<body onload="javascript:initBoxes()">
		<!-- display the title of the food -->
		<div>
			<br /><br />
			<span class="foodTitle">Add</span>
			<span class="foodTitleName">

<?php
			// decode any special characters in the foodname
			$name = urldecode($_POST["hidFoodName"]);
			echo $name;
?>

			</span>
			<span class="foodTitle">to Database</span>
			<br /><br /><br /><br />
		</div>

		<!-- form for entering the food values -->
		<form action="addToDB.php" method="post">
			<div><input type="hidden" id="txtName" name="txtName" value="<?php echo $name; ?>" /></div>

			<table class="addFoodFormTable">
				<tr>
					<td class="cellFoodValueTop">
						<b>quantity</b><br />
						<input class="ip1" type="text" id="txtQuantity" name="txtQuantity" maxlength="4" />
					</td>
					<td class="cellFoodValueTop" colspan="2">
						<b>units</b><br />
						<input class="ip2" type="text" id="txtUnits" name="txtUnits" maxlength="10" />
					</td>
					<td class="cellFoodValueTop" colspan="3">
						<b>carbohydrate</b><br />
						<input class="ip3" type="text" id="txtCarbohydrate" name="txtCarbohydrate" maxlength="5" />&nbsp;grams
					</td>
					<!-- trace -->
					<td rowspan="2">
						<div class="ip3b"><input type="checkbox" id="chkCarbohydrate" name="chkCarbohydrate" onclick="javascript:trace(this);" /></div>
						<div class="ip4"><input type="checkbox" id="chkCalories" name="chkCalories" onclick="javascript:trace(this);" /></div>
						<div class="ip5"><input type="checkbox" id="chkSugar" name="chkSugar" onclick="javascript:trace(this);" /></div>
						<div class="ip6"><input type="checkbox" id="chkFat" name="chkFat" onclick="javascript:trace(this);" /></div>
						<div class="ip7"><input type="checkbox" id="chkSaturates" name="chkSaturates" onclick="javascript:trace(this);" /></div>
						<div class="ip8"><input type="checkbox" id="chkSalt" name="chkSalt" onclick="javascript:trace(this);" /></div>
					</td>
				</tr>
				<tr>
					<td class="cellFoodValue">
						<b>calories</b><br />
						<input class="ip4" type="text" id="txtCalories" name="txtCalories" maxlength="5" />&nbsp;kcals
					</td>
					<td class="cellFoodValue">
						<b>sugar</b><br />
						<input class="ip5" type="text" id="txtSugar" name="txtSugar" maxlength="5" />&nbsp;grams
					</td>
					<td class="cellFoodValue">
						<b>fat</b><br />
						<input class="ip6" type="text" id="txtFat" name="txtFat" maxlength="5" />&nbsp;grams
					</td>
					<td class="cellFoodValue">
						<b>saturates</b><br />
						<input class="ip7" type="text" id="txtSaturates" name="txtSaturates" maxlength="5" />&nbsp;grams
					</td>
					<td class="cellFoodValue">
						<b>salt</b><br />
						<input class="ip8" type="text" id="txtSalt" name="txtSalt" maxlength="5" />&nbsp;grams
					</td>
				</tr>
			</table>


			<div>
				<br /><br /><br /><br />
				Admin Password:<br />
				<input type="password" name="txtPassword" /><br /><br />
			</div>

			<!-- this table is used to center the buttons -->
			<table class="btnHolder">
				<tr><td>
					<div class="buttons">

						<!-- back button -->
						<button type="button" class="negative" id="btnBack" name="btnBack" onclick="window.location='../index.php'">
							<img src="../buttons/minus.png" alt="" />&nbsp;Back
						</button>

						<!-- submit button -->
						<button type="submit" class="positive" id="btnSubmit" name="btnSubmit">
							<img src="../buttons/plus.png" alt="" />&nbsp;Submit
						</button>

					</div>
				</td></tr>
			</table>
		</form>

		<!-- label example -->
		<div>
			<br /><br /><br /><br /><br /><br /><br /><br />
			<b>Example food label:</b><br /><br />
			<img src="eg.jpg" alt="Example" height="214" width="214" />
		</div>

	</body>
</html>