<?php
	require_once "../../common.php";
	
	initialize($_SERVER);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			create_head("Folding@Home GPU Statistics Database - Disclaimer", "../../styles/default.css");
		?>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
	</head>
	<body>
		<?php
			create_header("Folding@Home GPU Statistics Database", "Disclaimer");
			create_vertical_space("20px");
		?>
		<div id="bodyer">
			Please note that there is a possibility that information in the database could be incorrect due to numerous factors.
			It is important to note this possibility so, if using The Database as a buying guide, that the purchase of a video/graphics card is not mistakenly made, with the expected results of the card greater than the actual output of the card.
			Please recall that The Pande Group advises that hardware not be bought with the sole intent for folding. 
			<br><br>
			The Database Administrator will do his best to maintain the database to the best possible accuracy as much as possible.
			Also note that The Database Administrator is human and is capable of mistakes.
			It is also possible that The Database could be fully accurate, however, The User should always assume there is a mistake present in The Database and take caution with that in mind.
			<br><br>
			To summarize the above: 
			<br>
			<span style="font-weight:900;">The Database IS PROVIDED "AS IS" AND WITHOUT WARRANTY. NEITHER The Database NOR The Pande Group IS TO BE HELD RESPONSIBLE FOR "REGRET PURCHASES" OR MISINFORMATION BECAUSE OF The Database. The Database IS A THIRD PARTY PROJECT THAT IS NOT AFFILIATED WITH The Pande Group OR ITS PARTNERS.</span>
			<br><br>
			The Database information provided by the source may not match the current database record. This is because of an attempt to keep The Database as accurate and constistent as possible.
			<br>
			While nearly all records will be added to The Database, there is a possibility that some data submissions may not be accepted and added to the database. Addition of data to The Database is at The Database Administrator's discretion and data that is found to be artificially made will be denied submission to The Database.
			<br><br>
			The Database is provided to the public free of charge. It is the purpose of The Database and the intent of its Administrator to have the public learn from the information The Database receives and provides.
			<br><br>
			Thank You for reading!
			<br><br>
			<a href="../../redirect.php?target=fah-gpu-database">Return to Browsing the Database</a>
			<br><br>
			Some links provided for convenience:
			<table>
				<tr>
					<td>
						<a href="http://folding.stanford.edu/English/FAQ-Policies" target="_blank">The Rules and Policies for Folding@Home</a>
					</td>
				</tr>
				<tr>
					<td>
						<a href="http://folding.stanford.edu/English/FAQ-BestPractices" target="_blank">The Best Practices for Folding@Home</a>
					</td>
				</tr>
				<tr>
					<td>
						<a href="http://folding.stanford.edu/English/License" target="_blank">The Folding@Home EULA</a>
					</td>
				</tr>
			</table>
		</div>
		<?php
			create_footer("www.compdewddevelopment.com/redirect.php?target=fah-gpu-database-disclaimer");
		?>
	</body>
</html>