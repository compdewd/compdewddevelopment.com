<?php
	require_once "../../common.php";
	
	initialize($_SERVER);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			create_head("Folding@Home GPU Statistics Database - About", "../../styles/default.css");
		?>
		
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
	</head>
	<body>
		<?php
			create_header("Folding@Home GPU Statistics Database", "About");
		?>
		</div>
		<?php
			create_vertical_space("20px");
		?>
		<div id="bodyer">
			The Folding@Home GPU Statistics Database is a collection of data from Folding@Home donors whom were willing to take a few minutes and submit their graphic card's statistics to the database. It is a third party project that is not affiliated with The Pande Group or its partners.
			<br><br>
			The database was created August 18, 2012 and is being actively maintained and developed to this day.
			<br><br>
			If you are anticipating using the database for a purchase or are relying on the database for some other reason, please take note of <a href="disclaimer.php">the database disclaimer/waiver</a>.
			<br><br>
			The database updates are kept in a thread on foldingforum.org and can be found <a href="http://foldingforum.org/viewtopic.php?f=14&t=22281" target="_blank">here</a>.
			<br><br>
			<a href="../../redirect.php?target=fah-gpu-database">Return to Browsing the Database</a>
			<br><br>
			Other helpful links:
			<table>
				<tr>
					<td>
						What is Folding@Home? <a href="http://folding.stanford.edu/English/FAQ-main" target="_blank">Read the F@H FAQ</a>
					</td>
				</tr>
				<tr>
					<td>
						How Can I Help Folding@Home? <a href="http://folding.stanford.edu/">Download the Software from the F@H Homepage</a>
					</td>
				</tr>
				<tr>
					<td>
						How Can I Help The Database? <a href="add.php">Submit Some Data!</a>
					</td>
				</tr>
			</table>
		</div>
		<?php
			create_footer("compdewddevelopment.com/redirect.php?target=about-fah-gpu-database");
		?>
	</body>
</html>