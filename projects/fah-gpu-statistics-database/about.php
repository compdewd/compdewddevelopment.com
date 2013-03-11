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
			create_vertical_space("20px");
		?>
		<div id="bodyer">
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